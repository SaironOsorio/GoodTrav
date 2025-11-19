<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationDetails;

    /**
     * Create a new message instance.
     *
     * @param array $reservationDetails
     */
    public function __construct(array $reservationDetails)
    {
        $this->reservationDetails = $reservationDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva Reserva Creada')
            ->view('emails.reservation-created')
            ->with('details', $this->reservationDetails);
    }
}
