<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
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
        return $this->subject('Konfirmasi Pemesanan Anda')
            ->view('emails.booking_confirmation')
            ->with([
                'booking' => $this->booking,
            ]);
    }
}
