<?php

namespace App\Mail;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailMail extends BaseMailer
{
    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the email subject.
     *
     * @return string
     */
    protected function getSubject(): string
    {
        return 'Welcome to KitesurfingVS - Activate Your Account';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verificationUrl = $this->verificationUrl();

        return parent::build()
            ->view('emails.verify-email')
            ->with([
                'user' => $this->user,
                'verificationUrl' => $verificationUrl,
            ]);
    }

    /**
     * Get the verification URL for the given user.
     *
     * @return string
     */
    protected function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'password.set.form',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $this->user->getKey(),
                'hash' => sha1($this->user->getEmailForVerification()),
            ]
        );
    }
}
