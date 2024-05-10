<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class SendReceiptOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $orderItems;
    public $totalAmount;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->user = User::find($order->buyer_id);
        $this->orderItems = OrderItem::with('getProduct')->where('order_id', $order->id)->get();
        $this->totalAmount = $order->total_amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Receipt for Your Order';

        return $this->subject($subject)
            ->view('payment.emailReceiptOrder');
    }
}
