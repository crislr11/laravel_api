<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\PDF;

class RegisteredEventsMail extends Mailable
{
    use Queueable;

    public $user;
    protected PDF $pdf;

    // Constructor que recibe el PDF generado
    public function __construct($pdf, $user)
    {
        $this->pdf = $pdf;
        $this->user = $user;
    }

    public function build()
    {
        // Envía el correo con el archivo PDF adjunto
        return $this->subject('Eventos Registrados')
                    ->view('emails.registeredEvents')  // Vista del correo
                    ->with(['user' => $this->user])
                    ->attachData($this->pdf->output(), 'registered_events.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}

