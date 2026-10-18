<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserLoginNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public User $user,
        public ?string $ipAddress = null,
        public ?string $userAgent = null,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name', 'Zeytinci Abi').' hesabınıza giriş yapıldı',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.auth.login',
            with: [
                'user' => $this->user,
                'brandName' => 'Zeytinci Abi',
                'brandSubtitle' => 'Bayi ve yönetim paneli',
                'supportEmail' => config('mail.from.address'),
                'ipAddress' => $this->ipAddress,
                'userAgent' => $this->userAgent,
                'loginTime' => now(),
                'panelUrl' => route('dashboard'),
                'logoUrl' => asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png'),
                'heroUrl' => asset('assets/zeytinci-abi/06_zeytinyagi_urun_grubu.png'),
                'branchUrl' => asset('assets/zeytinci-abi/07_zeytin_dali_kose_dekor.png'),
            ],
        );
    }
}
