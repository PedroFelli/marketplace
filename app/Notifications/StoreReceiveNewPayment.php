<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreReceiveNewPayment extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['database','mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Houve uma alteração no pagamento')
            ->greeting('Olá Mally')
            ->line('Houve um uma alteração no status do seu pedido')
            ->action('Ver pedido', route('admin.orders.my'));
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Houve um uma alteração no status do seu pedido'
        ];
    }
}
