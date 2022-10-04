<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClienteCreateEmail extends Notification
{
    use Queueable;

    public $cliente;
    public $password;

    public function __construct($cliente, $password)
    {
        $this->cliente = $cliente;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('VetSystem Cliente'))
                    ->line('Suas credenciais de acesso em:')
                    ->action('VetSystem WebCliente', url('WebCliente'))
                    ->line('Seu E-mail: '.$this->cliente->email)
                    ->line('Senha: '.$this->password);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
