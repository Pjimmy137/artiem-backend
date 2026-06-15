<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionReserva extends Mailable
{
    use Queueable, SerializesModels;

    // Declaramos la variable pública para que la vista HTML tenga acceso a ella
    public $datosReserva;

    public function __construct($datosReserva)
    {
        $this->datosReserva = $datosReserva;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de tu reserva en ARTIEM Hotels',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmacion', // El archivo HTML del diseño del correo
        );
    }
}
