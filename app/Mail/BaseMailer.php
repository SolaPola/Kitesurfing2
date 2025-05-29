<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class BaseMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message with common settings.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->getSubject());
    }

    /**
     * Get the email subject.
     *
     * @return string
     */
    abstract protected function getSubject(): string;
}
