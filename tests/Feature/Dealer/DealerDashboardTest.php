<?php

namespace Tests\Feature\Dealer;

use App\Enums\DealerStatus;
use App\Enums\OrderStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\DealerEarning;
use App\Models\DealerProfile;
use App\Models\LandingPage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DealerDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_approved_dealer_dashboard_renders_live_metrics(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        $dealer = DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-9001',
            'dealer_slug' => 'ege-bayi',
            'display_name' => 'Ege Bayi',
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        $landingPage = LandingPage::create([
            'dealer_id' => $dealer->id,
            'title' => 'Ege Zeytinyağı',
            'slug' => 'ege-zeytinyagi',
            'is_active' => true,
            'published_at' => now(),
        ]);

        $order = Order::create([
            'order_number' => 'ZA-D-001',
            'dealer_id' => $dealer->id,
            'landing_page_id' => $landingPage->id,
            'customer_name' => 'Müşteri Ali',
            'customer_phone' => '05550000000',
            'customer_city' => 'İzmir',
            'customer_district' => 'Urla',
            'customer_address' => 'Merkez',
            'total_amount' => 1200,
            'dealer_total_cost' => 800,
            'dealer_total_profit' => 400,
            'order_status' => OrderStatus::Delivered,
        ]);

        DealerEarning::create([
            'dealer_id' => $dealer->id,
            'order_id' => $order->id,
            'amount' => 400,
        ]);

        $this->actingAs($user)
            ->get(route('dealer.dashboard'))
            ->assertOk()
            ->assertSee('Hoş geldin, Ege Bayi')
            ->assertSee('Toplam Sipariş')
            ->assertSee('ZA-D-001')
            ->assertSee('Ege Zeytinyağı');
    }

    public function test_dealer_dashboard_does_not_show_another_dealers_data(): void
    {
        [$user, $dealer] = $this->dealerUser('Birinci Bayi', 'birinci-bayi');
        [, $otherDealer] = $this->dealerUser('İkinci Bayi', 'ikinci-bayi');

        $landingPage = LandingPage::create([
            'dealer_id' => $otherDealer->id,
            'title' => 'Başka Bayi Landing',
            'slug' => 'baska-bayi-landing',
            'is_active' => true,
        ]);

        Order::create([
            'order_number' => 'OTHER-001',
            'dealer_id' => $otherDealer->id,
            'landing_page_id' => $landingPage->id,
            'customer_name' => 'Başka Müşteri',
            'customer_phone' => '05551111111',
            'customer_city' => 'Manisa',
            'customer_district' => 'Akhisar',
            'customer_address' => 'Merkez',
            'total_amount' => 999,
            'dealer_total_cost' => 600,
            'dealer_total_profit' => 399,
            'order_status' => OrderStatus::Delivered,
        ]);

        $this->actingAs($user)
            ->get(route('dealer.dashboard'))
            ->assertOk()
            ->assertDontSee('OTHER-001')
            ->assertDontSee('Başka Bayi Landing')
            ->assertDontSee('Başka Müşteri');
    }

    /**
     * @return array{0: User, 1: DealerProfile}
     */
    private function dealerUser(string $displayName, string $slug): array
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        $dealer = DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-'.strtoupper(str($slug)->replace('-', '')->substr(0, 6)->toString()),
            'dealer_slug' => $slug,
            'display_name' => $displayName,
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        return [$user, $dealer];
    }
}
