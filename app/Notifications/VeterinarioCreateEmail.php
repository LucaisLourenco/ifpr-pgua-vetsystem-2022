<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VeterinarioCreateEmail extends Notification
{
    use Queueable;

    public $veterinario;
    public $password;

    public function __construct($veterinario, $password)
    {
        $this->veterinario = $veterinario;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('Vet System Veterinário'))
                    ->line('Suas credenciais de acesso em:')
                    ->action('Vet System WebVeterinario', url('WebVeterinario'))
                    ->line('Seu E-mail: '.$this->veterinario->email)
                    ->line('Senha: '.$this->password);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
