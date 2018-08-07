<?php

namespace AvoRed\Framework\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use AvoRed\Framework\Models\Database\Order;

class OrderInvoicedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    protected $path;

    public function __construct(Order $order, $path)
    {
        $this->path = $path;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('avored-framework::mail.order-invoiced')
                    ->attach($this->path, ['as' => 'invoiced.pdf', 'mime' => 'application/pdf']);
        //->with('order', $this->order);
    }
}
