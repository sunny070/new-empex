<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SponsoredNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $spon, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $spon)
    {
        $this->user = $user;
        $this->spon = $spon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@empex.com', 'EmpEx')
            ->view('email.sponsored_notification');
    }
}
