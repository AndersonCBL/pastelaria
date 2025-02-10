<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        // Atribui o pedido à propriedade da classe
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Define a view que será utilizada para o e-mail e passa o pedido como variável
        return $this->view('emails.order_notification')
            ->subject('Pedido Criado')
            ->with([
                'order' => $this->order,
                'products' => $this->order->products,
            ]);
    }
}
