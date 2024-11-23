<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $view;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject($this->data['subject'] ?? env('APP_NAME'))
            ->view($this->view ?? 'emails.test', $this->data);
        if (isset($this->data['qrcode'])) {
            $qrCodeCid = 'qrCodeImage_'.md5(uniqid());
            $email->attachData($this->data['qrcode'], 'qrcode.png', [
                'mime' => 'image/png',
                'as' => 'qrcode.png',
                'disposition' => 'inline', // Set disposition to inline to embed the image
                'cid' => $qrCodeCid, // Attach the image with the same CID as in the view
            ]);
        }

        return $email;
    }
}
