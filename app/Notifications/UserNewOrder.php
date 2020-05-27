<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNewOrder extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Você fez um novo pedido. Estamos processando o pagamento.')
                    ->line('Você pode acompanhar o status do seu pedido.')
                    ->action('Meus pedidos', url('/'))
                    ->line('Obrigado por comprar em nossa Loja');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Obrigado por comprar em nossa loja'
        ];
    }
}
