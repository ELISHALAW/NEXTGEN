<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailCustom extends Notification
{
    use Queueable;

        public function __construct()
    {
        //
    }

        public function via($notifiable): array
    {
        return ['mail'];
    }

        public function toMail($notifiable): MailMessage
    {
        // 1. Generate the URL specifically for your Password Reset route
        // This looks for the route named 'password.reset' in your web.php
        $url = url(route('password.reset', [
            'token' => bin2hex(random_bytes(32)), // Usually this comes from your Password Broker
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->view('emails.verify-custom', [ // Your blue/white design
                'url' => $url, // Now linked to auth.resetPassword
                'name' => $notifiable->name ?? 'User'
            ]);
    }
}