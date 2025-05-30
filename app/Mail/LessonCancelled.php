<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\BookingLessonSession;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LessonCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $session;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, BookingLessonSession $session, string $reason)
    {
        $this->booking = $booking;
        $this->session = $session;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('KitesurfingVS: Your Lesson Has Been Cancelled')
                   ->view('emails.lesson-cancelled');
    }
}
