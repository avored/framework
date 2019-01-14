<?php

namespace AvoRed\Framework\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ProductBeforeSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Product Before Save Post Data from Form
     *
     * @var array $data
     */

    public $data = [];

    /**
     * Create a new event instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
}
