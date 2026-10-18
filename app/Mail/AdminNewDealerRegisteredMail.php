<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewDealerRegisteredMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public User $user, public string $method = 'form')
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name', 'Zeytinci Abi').' yeni bayi başvurusu',
        );
    }

    public function content(): Content
    {
        $dealer = $this->user->dealerProfile;

        return new Content(
            view: 'emails.admin.new-dealer-registered',
            with: [
                'user' => $this->user,
                'dealer' => $dealer,
                'method' => $this->method,
                'brandName' => 'Zeytinci Abi',
                'brandSubtitle' => 'Bayi başvuru bildirimi',
                'supportEmail' => config('mail.from.address'),
                'adminUrl' => $dealer ? route('admin.dealers.show', $dealer) : route('admin.dealers.pending'),
            ],
        );
    }
}
