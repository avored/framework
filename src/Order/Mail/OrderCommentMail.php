<?php

namespace AvoRed\Framework\Order\Mail;

use AvoRed\Framework\Database\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCommentMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * User Order Show Url
     * @param string $url
     */
    public $url;


    public function __construct(string $url)
    {
        $this->url = $url;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Order Comment')
            ->markdown('avored::order.order.comment-mail')
            ->with('url', $this->url);
    }
}
