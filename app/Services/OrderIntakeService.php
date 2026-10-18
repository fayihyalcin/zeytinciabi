<?php

namespace App\Services;

use App\Enums\EarningStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Customer;
use App\Models\DealerEarning;
use App\Models\LandingPage;
use App\Models\LandingPageProduct;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderIntakeService
{
    public function createFromLandingPage(LandingPage $landingPage, array $data): Order
    {
        return DB::transaction(function () use ($landingPage, $data): Order {
            $landingPage->loadMissing('dealer');

            if (! $landingPage->is_active || ! $landingPage->dealer?->isApproved()) {
                throw ValidationException::withMessages([
                    'landing_page' => 'Bu satış sayfası şu anda sipariş almaya uygun değil.',
                ]);
            }

            $items = collect($data['items']);
            $landingProducts = LandingPageProduct::with(['product', 'dealerProduct.productPrice'])
                ->where('landing_page_id', $landingPage->id)
                ->whereIn('id', $items->pluck('landing_page_product_id'))
                ->where('is_active', true)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($landingProducts->count() !== $items->pluck('landing_page_product_id')->unique()->count()) {
                throw ValidationException::withMessages([
                    'items' => 'Seçilen ürünlerden biri bu landing page için aktif değil.',
                ]);
            }

            $customer = Customer::create([
                'name' => $data['customer_name'],
                'phone' => $data['customer_phone'],
                'city' => $data['customer_city'],
                'district' => $data['customer_district'],
                'address' => $data['customer_address'],
            ]);

            $order = $this->createOrderWithUniqueNumber($landingPage, $customer, $data);

            $totals = ['amount' => 0, 'cost' => 0, 'profit' => 0];

            foreach ($items as $item) {
                /** @var LandingPageProduct $landingProduct */
                $landingProduct = $landingProducts[$item['landing_page_product_id']];
                $quantity = (int) $item['quantity'];
                $dealerBuyPrice = (float) ($landingProduct->dealerProduct?->productPrice?->dealer_buy_price ?? 0);
                $salePrice = (float) $landingProduct->sale_price;

                if (! $landingProduct->product?->is_active || ! $landingProduct->dealerProduct?->is_enabled || ! $landingProduct->dealerProduct?->productPrice?->is_active) {
                    throw ValidationException::withMessages([
                        'items' => "{$landingProduct->product?->name} ürünü şu anda siparişe uygun değil.",
                    ]);
                }

                $minSalePrice = (float) $landingProduct->dealerProduct->productPrice->min_sale_price;
                $maxSalePrice = $landingProduct->dealerProduct->productPrice->max_sale_price !== null
                    ? (float) $landingProduct->dealerProduct->productPrice->max_sale_price
                    : null;

                if ($salePrice < $minSalePrice || ($maxSalePrice !== null && $salePrice > $maxSalePrice)) {
                    throw ValidationException::withMessages([
                        'items' => "{$landingProduct->product->name} satış fiyatı güncel fiyat kurallarına uygun değil.",
                    ]);
                }

                $lineTotal = $salePrice * $quantity;
                $lineCost = $dealerBuyPrice * $quantity;
                $lineProfit = $lineTotal - $lineCost;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $landingProduct->product_id,
                    'dealer_product_id' => $landingProduct->dealer_product_id,
                    'landing_page_product_id' => $landingProduct->id,
                    'product_name_snapshot' => $landingProduct->product->name,
                    'quantity' => $quantity,
                    'dealer_buy_price_snapshot' => $dealerBuyPrice,
                    'sale_price_snapshot' => $salePrice,
                    'line_total' => $lineTotal,
                    'dealer_profit' => $lineProfit,
                ]);

                $totals['amount'] += $lineTotal;
                $totals['cost'] += $lineCost;
                $totals['profit'] += $lineProfit;
            }

            $order->update([
                'total_amount' => $totals['amount'],
                'dealer_total_cost' => $totals['cost'],
                'dealer_total_profit' => $totals['profit'],
            ]);

            DealerEarning::create([
                'dealer_id' => $landingPage->dealer_id,
                'order_id' => $order->id,
                'amount' => $totals['profit'],
                'status' => EarningStatus::Pending,
            ]);

            return $order->fresh(['items', 'earning']);
        });
    }

    private function createOrderWithUniqueNumber(LandingPage $landingPage, Customer $customer, array $data): Order
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            try {
                return Order::create([
                    'order_number' => $this->nextOrderNumber(),
                    'dealer_id' => $landingPage->dealer_id,
                    'landing_page_id' => $landingPage->id,
                    'project_id' => $landingPage->project_id,
                    'customer_id' => $customer->id,
                    'customer_name' => $data['customer_name'],
                    'customer_phone' => $data['customer_phone'],
                    'customer_city' => $data['customer_city'],
                    'customer_district' => $data['customer_district'],
                    'customer_address' => $data['customer_address'],
                    'customer_note' => $data['customer_note'] ?? null,
                    'payment_method' => PaymentMethod::CashOnDelivery,
                    'payment_status' => PaymentStatus::CodPending,
                    'order_status' => OrderStatus::Pending,
                ]);
            } catch (QueryException $exception) {
                if (! $this->isUniqueConstraintViolation($exception) || $attempt === 4) {
                    throw $exception;
                }
            }
        }

        throw new \RuntimeException('Sipariş numarası üretilemedi.');
    }

    private function nextOrderNumber(): string
    {
        return 'ZA'.now()->format('YmdHisv').random_int(1000, 9999);
    }

    private function isUniqueConstraintViolation(QueryException $exception): bool
    {
        return in_array((string) $exception->getCode(), ['23000', '23505'], true);
    }
}
