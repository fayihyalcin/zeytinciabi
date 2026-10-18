<?php

namespace Tests\Feature\Auth;

use App\Enums\DealerStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\DealerProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_open_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'status' => UserStatus::Active,
        ]);

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertOk();
    }

    public function test_dealer_cannot_open_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertForbidden();
    }

    public function test_pending_dealer_is_redirected_from_dealer_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-0001',
            'dealer_slug' => 'test-bayi',
            'display_name' => 'Test Bayi',
            'status' => DealerStatus::Pending,
        ]);

        $this->actingAs($user)
            ->get('/dealer/dashboard')
            ->assertRedirect(route('dealer.pending'));
    }

    public function test_approved_dealer_can_open_dealer_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-0002',
            'dealer_slug' => 'onayli-bayi',
            'display_name' => 'Onaylı Bayi',
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        $this->actingAs($user)
            ->get('/dealer/dashboard')
            ->assertOk();
    }

    public function test_passive_user_cannot_open_protected_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'status' => UserStatus::Passive,
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertRedirect(route('login'));
    }

    public function test_passive_user_cannot_open_profile_surface(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Passive,
        ]);

        $this->actingAs($user)
            ->get('/profile')
            ->assertRedirect(route('login'));
    }

    public function test_passive_user_cannot_open_auth_account_surfaces(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Passive,
        ]);

        $this->actingAs($user)
            ->get('/confirm-password')
            ->assertRedirect(route('login'));

        $this->assertGuest();

        $this->actingAs($user)
            ->get('/verify-email')
            ->assertRedirect(route('login'));
    }
}
