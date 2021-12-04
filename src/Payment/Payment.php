<?php
namespace AvoRed\Framework\Payment;

use Illuminate\Support\Facades\Facade;
/**
 * @method static \AvoRed\Framework\Payment\PaymentManager all(): Collection
 */
class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
