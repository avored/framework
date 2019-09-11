<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Configuration;

interface ConfigurationModelInterface
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

    /**
     * create configuration by given data.
     * @param array $data
     * @return string $value
     */
    public function create(array $data): Configuration;
}
