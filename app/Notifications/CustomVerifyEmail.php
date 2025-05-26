<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Подтверждение регистрации')
            ->greeting('Подтверждение регистрации')
            ->line('Для подтверждения регистрации нажмите кнопку ниже:')
            ->action('Подтвердить регистрацию', $verificationUrl)
            ->line('В случае, если вы получили это письмо по ошибке, просто проигнорируйте его.');
    }
}
