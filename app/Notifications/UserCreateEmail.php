<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreateEmail extends Notification
{
    use Queueable;

    public $user;
    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('Vet System Sistema'))
                    ->line('Suas credenciais de acesso em:')
                    ->action('Vet System Sistema', url('sistema'))
                    ->line('Seu E-mail: '.$this->user->email)
                    ->line('Senha: '.$this->password);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
