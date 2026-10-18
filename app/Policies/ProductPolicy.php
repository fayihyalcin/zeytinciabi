<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function view(User $user, Product $product): bool
    {
        if ($user->hasAdminAccess()) {
            return true;
        }

        return $user->isDealer()
            && $product->is_active
            && $user->dealerProfile()
                ->whereHas('dealerProducts', fn ($query) => $query
                    ->where('product_id', $product->id)
                    ->where('is_enabled', true))
                ->exists();
    }
}
