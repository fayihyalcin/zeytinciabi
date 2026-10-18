<?php

namespace App\Services;

use App\Mail\UserWelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserWelcomeMailService
{
    public function send(User $user): void
    {
        if (! $user->email || ! $this->enabled()) {
            return;
        }

        try {
            Mail::to($user->email)->send(new UserWelcomeMail($user->fresh('dealerProfile')));
        } catch (Throwable $exception) {
            Log::warning('Welcome email could not be sent.', [
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
