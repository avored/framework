<?php

namespace AvoRed\Framework\Payment\Contracts;

interface Payment
{
    /***
     *
     * Get Identifier for the Payment Gateway
     *
     *
     * @return String
     */
    public function identifier();

    /***
     *
     * Get Display Name for the Payment Gateway
     *
     *
     * @return String
     */
    public function name();

    /***
     *
     * To check if Payment Gateway is Enabled?
     *
     *
     * @return Boolean
     */
    public function enable();

    /***
     *
     * Returns View Path for the view files
     *
     *
     * @return String
     */
    public function view();

    /***
     *
     * Returns Array Containing Required Variables for the View
     *
     *
     * @return Array
     */
    public function with();
}
