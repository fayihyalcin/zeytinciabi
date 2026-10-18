<?php

namespace Tests\Feature\Auth;

use App\Enums\DealerStatus;
use App\Enums\UserRole;
use App\Mail\AdminNewDealerRegisteredMail;
use App\Mail\UserLoginNotificationMail;
use App\Mail\UserWelcomeMail;
use App\Models\DealerProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Tests\TestCase;

class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_auth_redirect_requires_configuration(): void
    {
        config([
            'services.google.client_id' => null,
            'services.google.client_secret' => null,
        ]);

        $this->get(route('auth.google'))
            ->assertRedirect(route('register'));
    }

    public function test_google_callback_creates_pending_dealer_applicant(): void
    {
        Mail::fake();

        config([
            'services.google.client_id' => 'client-id',
            'services.google.client_secret' => 'client-secret',
            'services.google.redirect' => 'http://127.0.0.1:8000/auth/google/callback',
        ]);

        $googleUser = new SocialiteUser;
        $googleUser->map([
            'id' => 'google-123',
            'name' => 'Google Bayi',
            'email' => 'google-bayi@example.com',
        ]);

        Socialite::shouldReceive('driver')
            ->once()
            ->with('google')
            ->andReturn(new class ($googleUser) {
                public function __construct(private readonly SocialiteUser $user)
                {
                }

                public function redirectUrl(string $url): self
                {
                    return $this;
                }

                public function user(): SocialiteUser
                {
                    return $this->user;
                }
            });

        $this->get(route('auth.google.callback'))
            ->assertRedirect(route('dealer.pending'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'google-bayi@example.com',
            'google_id' => 'google-123',
            'role' => UserRole::Dealer->value,
        ]);

        $user = User::where('email', 'google-bayi@example.com')->firstOrFail();
        $dealer = DealerProfile::where('user_id', $user->id)->firstOrFail();

        $this->assertSame(DealerStatus::Pending, $dealer->status);
        $this->assertSame('Google Bayi', $dealer->display_name);

        Mail::assertSent(UserWelcomeMail::class, fn (UserWelcomeMail $mail) => $mail->hasTo('google-bayi@example.com'));
        Mail::assertSent(AdminNewDealerRegisteredMail::class);
        Mail::assertNotSent(UserLoginNotificationMail::class);
    }

    public function test_google_callback_sends_login_notification_for_existing_user(): void
    {
        Mail::fake();

        config([
            'services.google.client_id' => 'client-id',
            'services.google.client_secret' => 'client-secret',
            'services.google.redirect' => 'http://127.0.0.1:8000/auth/google/callback',
        ]);

        $user = User::factory()->create([
            'name' => 'Mevcut Bayi',
            'email' => 'mevcut-bayi@example.com',
            'google_id' => 'google-existing',
            'role' => UserRole::Dealer,
        ]);

        DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-EXISTING',
            'dealer_slug' => 'mevcut-bayi',
            'display_name' => 'Mevcut Bayi',
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        $googleUser = new SocialiteUser;
        $googleUser->map([
            'id' => 'google-existing',
            'name' => 'Mevcut Bayi',
            'email' => 'mevcut-bayi@example.com',
        ]);

        Socialite::shouldReceive('driver')
            ->once()
            ->with('google')
            ->andReturn(new class ($googleUser) {
                public function __construct(private readonly SocialiteUser $user)
                {
                }

                public function redirectUrl(string $url): self
                {
                    return $this;
                }

                public function user(): SocialiteUser
                {
                    return $this->user;
                }
            });

        $this->get(route('auth.google.callback'))
            ->assertRedirect(route('dealer.pending'));

        $this->assertAuthenticatedAs($user);

        Mail::assertSent(UserLoginNotificationMail::class, fn (UserLoginNotificationMail $mail) => $mail->hasTo('mevcut-bayi@example.com'));
        Mail::assertNotSent(UserWelcomeMail::class);
        Mail::assertNotSent(AdminNewDealerRegisteredMail::class);
    }
}
