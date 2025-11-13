<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $telefono;
    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $telefono, $message)
    {
        $this->name = trim((string) $name);
        $this->email = trim((string) $email);
        $this->telefono = trim((string) $telefono);
        $this->content = trim((string) $message);

        Log::info('ContactFormMail variables:', [
            'name' => "'{$this->name}'",
            'email' => "'{$this->email}'",
            'telefono' => "'{$this->telefono}'",
            'message' => "'{$this->content}'",
        ]);
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuevo mensaje de contacto')
                    ->view('emails.contact-form');
    }
}
