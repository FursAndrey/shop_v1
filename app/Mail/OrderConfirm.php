<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, Order $order)
    {
        $this->name = $name;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fullSum = $this->order->getOrderSum();
        return $this->view(
            'mail.confirmOrder', 
            [
                'name' => $this->name,
                'fullSum' => $fullSum,
            ]
        );
    }
}
