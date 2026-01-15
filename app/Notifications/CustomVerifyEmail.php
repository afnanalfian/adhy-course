<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomVerifyEmail extends VerifyEmail implements ShouldQueue
{
    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->view('emails.verify', [
                'user' => $notifiable,
                'verificationUrl' => $url
            ]);
    }
}
