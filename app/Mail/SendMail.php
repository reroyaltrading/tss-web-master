<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = isset($this->data['from']) ? $this->data['from'] : 'no-reply@blascke.com';
        $subject = isset($this->data['subject']) ? $this->data['subject'] : 'New costumer';
        return $this->from($from)->subject($subject)->view('emails.common')->with('data', $this->data);
    }
}
