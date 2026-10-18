<?php

namespace App\Services;

use App\Mail\UserLoginNotificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserLoginMailService
{
    public function send(User $user, ?string $ipAddress = null, ?string $userAgent = null): void
    {
        if (! $user->email || ! $this->enabled()) {
            return;
        }

        try {
            Mail::to($user->email)->send(new UserLoginNotificationMail($user, $ipAddress, $userAgent));
        } catch (Throwable $exception) {
            Log::warning('Login notification email could not be sent.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    private function enabled(): bool
    {
        return filter_var(env('MAIL_NOTIFICATIONS_ENABLED', true), FILTER_VALIDATE_BOOLEAN);
    }
}
