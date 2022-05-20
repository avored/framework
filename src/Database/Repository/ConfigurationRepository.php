<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Models\Configuration;

class ConfigurationRepository extends BaseRepository implements ConfigurationModelInterface
{
    /**
    * Eloquent Model Instant for the Repository
    * @var \AvoRed\Framework\Database\Models\Configuration
    */
    protected $model;

    /**
     * Construct for the Category Repository
     *
     */
    public function __construct()
    {
        $this->model = new Configuration();
    }

    /**
     * Model object for the repository
     * @return \AvoRed\Framework\Database\Models\Configuration $model
     */
    public function model(): Configuration
    {
        return $this->model;
    }

    /**
     * Get value of a configuration by given code.
     * @param string $code
     * @return string $value
     */
    public function getValueByCode($code)
    {
        $configuration = Configuration::whereCode($code)->first();

        if ($configuration === null) {
            return;
        }

        return $configuration->value;
    }

    /**
     * Get model of a configuration by given code.
     * @param string $code
     * @return string $value
     */
    public function getModelByCode($code)
    {
        $configuration = Configuration::whereCode($code)->first();

        if ($configuration === null) {
            return;
        }

        return $configuration;
    }

    /**
     * create configuration by given data.
     * @param array $data
     * @return string $value
     */
    public function create(array $data): Configuration
    {
        return Configuration::create($data);
    }
}
