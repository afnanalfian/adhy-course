<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GlobalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $message,
        public ?string $url = null,
        public bool $sendEmail = false
    ) {}

    public function via($notifiable): array
    {
        return $this->sendEmail
            ? ['database', 'mail']
            : ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => $this->message,
            'url'     => $this->url,
        ];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(config('app.name').' Notification')
            ->view('emails.notification', [
                'user'    => $notifiable,
                'message' => $this->message,
                'url'     => $this->url,
            ]);
    }
}
