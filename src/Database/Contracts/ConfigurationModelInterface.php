<?php

namespace AvoRed\Framework\Database\Contracts;

interface ConfigurationModelInterface extends BaseInterface
{
    /**
     * Get value of a configuration by given code.
     * @param string $code
     * @return string $value
     */
    public function getValueByCode($code);

    /**
     * Get model of a configuration by given code.
     * @param string $code
     * @return string $value
     */
    public function getModelByCode($code);
}