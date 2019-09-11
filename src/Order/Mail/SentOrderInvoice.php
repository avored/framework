<?php

namespace AvoRed\Framework\Order\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentOrderInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Attachment Invoice Path.
     * @var string
     */
    protected $path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Order Invoice')
            ->markdown('avored::order.order.mail')
            ->attach($this->path, [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
