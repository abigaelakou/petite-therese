<?php

namespace App\Mail;

use App\Models\Circulaire;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CirculairePubliee extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Circulaire $circulaire) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[GSCA La Petite Thérèse] ' . $this->circulaire->titre,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.circulaire-publiee',
        );
    }
}