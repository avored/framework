<?php

namespace AvoRed\Framework\Shipping\Contracts;

interface Shipping
{
    /***
     *
     * Get Identifier for the Shipping Option
     *
     *
     * @return String
     */
    public function identifier();

    /***
     *
     * Get Display Name for the Shipping Option
     *
     *
     * @return String
     */
    public function name();

    /***
     *
     * To check if Shipping Option is Enabled?
     *
     *
     * @return Boolean
     */
    public function enable();
}
