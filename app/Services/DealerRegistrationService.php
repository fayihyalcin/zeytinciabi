<?php

namespace App\Services;

use App\Enums\DealerStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\DealerProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DealerRegistrationService
{
    public function __construct(private readonly SlugService $slugService)
    {
    }

    public function register(array $data): User
    {
        return DB::transaction(function () use ($data): User {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'password' => Hash::make($data['password']),
                'role' => UserRole::Dealer,
                'status' => UserStatus::Active,
            ]);

            $dealerProfile = DealerProfile::create([
                'user_id' => $user->id,
                'dealer_code' => 'PENDING-'.$user->id,
                'dealer_slug' => $this->slugService->unique($data['display_name'], DealerProfile::class, 'dealer_slug'),
                'company_name' => $data['company_name'] ?? null,
                'display_name' => $data['display_name'],
                'identity_number' => $data['identity_number'] ?? null,
                'tax_number' => $data['tax_number'] ?? null,
                'iban' => $data['iban'] ?? null,
                'bank_name' => $data['bank_name'] ?? null,
                'city' => $data['city'] ?? null,
                'district' => $data['district'] ?? null,
                'address' => $data['address'] ?? null,
                'instagram_url' => $data['instagram_url'] ?? null,
                'facebook_url' => $data['facebook_url'] ?? null,
                'tiktok_url' => $data['tiktok_url'] ?? null,
                'whatsapp_phone' => $data['whatsapp_phone'] ?? ($data['phone'] ?? null),
                'status' => DealerStatus::Pending,
            ]);

            $dealerProfile->update([
                'dealer_code' => 'ZA-'.str_pad((string) $dealerProfile->id, 5, '0', STR_PAD_LEFT),
            ]);

            return $user;
        });
    }
}
