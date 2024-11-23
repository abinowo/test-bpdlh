<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RescheduleConfirmation extends Mailable
{
    use SerializesModels;

    protected $booking;

    // Menerima data pemesanan untuk dikirimkan dalam email
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // Membuat tampilan untuk email
    public function build()
    {
        return $this->subject('Reschedule Your Booking')
            ->view('emails.reschedule')
            ->with([
                'booking' => $this->booking,
            ]);
    }
}
