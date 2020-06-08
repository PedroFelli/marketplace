<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserReceiveNewPayment extends Notification
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
            ->subject('Recebemos o seu pagamento!')
            ->line('Recebemos o seu pagamento e o pedido está sendo separado para entrega')
            ->line('Você pode acompanhar o status do seu pedido.')
            ->action('Meus pedidos', url('/'))
            ->line('Obrigado por comprar em nossa Loja');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
