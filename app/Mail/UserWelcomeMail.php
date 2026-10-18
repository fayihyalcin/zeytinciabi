<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserWelcomeMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name', 'Zeytinci Abi').' bayi başvurunuz alındı',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.auth.welcome',
            with: [
                'user' => $this->user,
                'dealer' => $this->user->dealerProfile,
                'brandName' => 'Zeytinci Abi',
                'brandSubtitle' => 'Stoksuz zeytinyağı bayilik sistemi',
                'supportEmail' => config('mail.from.address'),
                'panelUrl' => route('dealer.pending'),
                'logoUrl' => asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png'),
                'heroUrl' => asset('assets/zeytinci-abi/03_hero_bayi_sen_bayi.png'),
                'branchUrl' => asset('assets/zeytinci-abi/07_zeytin_dali_kose_dekor.png'),
            ],
        );
    }
}
