<?php

namespace App\Services;

use App\Mail\AdminNewDealerRegisteredMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AdminRegistrationNotificationMailService
{
    public function sendNewDealer(User $user, string $method = 'form'): void
    {
        $recipient = env('ADMIN_NOTIFICATION_EMAIL', config('mail.from.address'));

        if (! $recipient || ! $this->enabled()) {
            return;
        }

        try {
            Mail::to($recipient)->send(new AdminNewDealerRegisteredMail($user->fresh('dealerProfile'), $method));
        } catch (Throwable $exception) {
            Log::warning('Admin new dealer registration email could not be sent.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'admin_email' => $recipient,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    private function enabled(): bool
    {
        return filter_var(env('MAIL_NOTIFICATIONS_ENABLED', true), FILTER_VALIDATE_BOOLEAN);
    }
}
