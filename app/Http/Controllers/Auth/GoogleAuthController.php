<?php

namespace App\Http\Controllers\Auth;

use App\Enums\DealerStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\DealerProfile;
use App\Models\User;
use App\Services\AdminRegistrationNotificationMailService;
use App\Services\SlugService;
use App\Services\UserLoginMailService;
use App\Services\UserWelcomeMailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        if (! $this->googleOAuthConfigured()) {
            return redirect()
                ->route('register')
                ->with('status', 'Google ile kayıt ayarları henüz tamamlanmamış.');
        }

        return Socialite::driver('google')
            ->redirectUrl($this->googleRedirectUrl())
            ->redirect();
    }

    public function callback(
        SlugService $slugService,
        UserWelcomeMailService $welcomeMailService,
        UserLoginMailService $loginMailService,
        AdminRegistrationNotificationMailService $adminRegistrationMailService
    ): RedirectResponse {
        try {
            if (! $this->googleOAuthConfigured()) {
                throw new \RuntimeException('Google OAuth credentials are missing.');
            }

            $googleUser = Socialite::driver('google')
                ->redirectUrl($this->googleRedirectUrl())
                ->user();

            if (! $googleUser->getEmail()) {
                return redirect()
                    ->route('register')
                    ->with('status', 'Google hesabından e-posta alınamadı. Lütfen form ile başvuru yapın.');
            }

            $wasCreated = false;

            $user = DB::transaction(function () use ($googleUser, $slugService, &$wasCreated): User {
                $user = User::query()
                    ->where('email', $googleUser->getEmail())
                    ->orWhere('google_id', $googleUser->getId())
                    ->first();

                if ($user) {
                    $user->forceFill([
                        'google_id' => $user->google_id ?: $googleUser->getId(),
                        'email_verified_at' => $user->email_verified_at ?: now(),
                        'last_login_at' => now(),
                    ])->save();

                    return $user;
                }

                $wasCreated = true;

                $user = User::create([
                    'name' => $googleUser->getName() ?: Str::before($googleUser->getEmail(), '@'),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(32)),
                    'role' => UserRole::Dealer,
                    'status' => UserStatus::Active,
                    'email_verified_at' => now(),
                    'last_login_at' => now(),
                ]);

                $dealerProfile = DealerProfile::create([
                    'user_id' => $user->id,
                    'dealer_code' => 'PENDING-'.$user->id,
                    'dealer_slug' => $slugService->unique($user->name, DealerProfile::class, 'dealer_slug'),
                    'display_name' => $user->name,
                    'whatsapp_phone' => $user->phone,
                    'status' => DealerStatus::Pending,
                ]);

                $dealerProfile->update([
                    'dealer_code' => 'ZA-'.str_pad((string) $dealerProfile->id, 5, '0', STR_PAD_LEFT),
                ]);

                return $user;
            });

            Auth::login($user);
            request()->session()->regenerate();

            if ($wasCreated) {
                $welcomeMailService->send($user);
                $adminRegistrationMailService->sendNewDealer($user, 'google');
            } else {
                $loginMailService->send($user, request()->ip(), request()->userAgent());
            }

            return redirect()->route($user->isDealer() ? 'dealer.pending' : 'dashboard')
                ->with('status', $user->isDealer() ? 'Google hesabınızla bayi başvurunuz alındı.' : 'Google hesabınızla giriş yaptınız.');
        } catch (\Throwable $exception) {
            Log::error('Google OAuth failed.', [
                'message' => $exception->getMessage(),
                'exception' => $exception::class,
            ]);

            return redirect()
                ->route('register')
                ->with('status', 'Google ile kayıt sırasında hata oluştu. Lütfen tekrar deneyin.');
        }
    }

    private function googleOAuthConfigured(): bool
    {
        return filled(config('services.google.client_id'))
            && filled(config('services.google.client_secret'));
    }

    private function googleRedirectUrl(): string
    {
        return config('services.google.redirect') ?: route('auth.google.callback');
    }
}
