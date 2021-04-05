<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $details,$user;

    public function __construct($details,$user)
    {
        $this->details = $details;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Hotel Booked Successfully By".$this->user->id)->from('pratapbera01@gmail.com', 'HolydayHome')
                    ->view('emails.reservation-admin', ['details' => $this->details,'user'=>$this->user]);

    }
}
