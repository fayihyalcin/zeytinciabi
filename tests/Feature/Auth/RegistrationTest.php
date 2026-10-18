<?php

namespace Tests\Feature\Auth;

use App\Enums\DealerStatus;
use App\Enums\UserRole;
use App\Mail\AdminNewDealerRegisteredMail;
use App\Mail\UserWelcomeMail;
use App\Models\DealerProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_dealer_applicants_can_register(): void
    {
        Mail::fake();

        $response = $this->post('/register', [
            'name' => 'Ayse Sahin',
            'email' => 'ayse@example.com',
            'phone' => '05551234567',
            'display_name' => 'Ayse Sahin Bayi',
            'company_name' => 'Sahin Zeytinyagi',
            'city' => 'Izmir',
            'district' => 'Cesme',
            'address' => 'Alacati mahallesi',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dealer.pending'));

        $user = User::where('email', 'ayse@example.com')->firstOrFail();
        $dealer = DealerProfile::where('user_id', $user->id)->firstOrFail();

        $this->assertSame(UserRole::Dealer, $user->role);
        $this->assertSame(DealerStatus::Pending, $dealer->status);
        $this->assertSame('ayse-sahin-bayi', $dealer->dealer_slug);
        $this->assertSame('ZA-00001', $dealer->dealer_code);

        Mail::assertSent(UserWelcomeMail::class, fn (UserWelcomeMail $mail) => $mail->hasTo('ayse@example.com'));
        Mail::assertSent(AdminNewDealerRegisteredMail::class);
    }

    public function test_registered_pending_dealer_is_blocked_until_admin_approval(): void
    {
        $this->post('/register', [
            'name' => 'Mehmet Kaya',
            'email' => 'mehmet@example.com',
            'display_name' => 'Mehmet Kaya Zeytinyagi',
            'city' => 'Aydin',
            'district' => 'Kusadasi',
            'address' => 'Sahil yolu',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->get('/dealer/dashboard')->assertRedirect(route('dealer.pending'));

        $dealer = DealerProfile::whereHas('user', fn ($query) => $query->where('email', 'mehmet@example.com'))->firstOrFail();

        $dealer->update([
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        $this->get('/dealer/dashboard')->assertOk();
    }
}
