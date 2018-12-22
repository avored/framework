<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Database\Configuration;

class ConfigurationRepository implements ConfigurationInterface
{
    /**
     * Find an Configuration by  given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Configuration
     */
    public function find($id)
    {
        return Configuration::find($id);
    }

    /**
     * Find an Configuration by  given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Configuration
     */
    public function findByKey($key)
    {
        return Configuration::whereConfigurationKey($key)->first();
    }

    /**
     * Find an Configuration_value  by  given configurationKey
     *
     * @param string $key
     * @return string $configurationValue
     */
    public function getValueByKey($key)
    {
        $model = Configuration::whereConfigurationKey($key)->first();

        if (null === $model) {
            return null;
        }

        return $model->configuration_value;
    }

    /**
     * Set an Configuration value  by  given configuration Key
     *
     * @param string $key
     * @return string $value
     */
    public function setValueByKey($key, $value)
    {
        $model = Configuration::whereConfigurationKey($key)->first();

        if (null === $model) {
            return null;
        }
        $model->update(['configuration_value' => $value]);

        return $model;
    }

    /**
     * Find all Configuration
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Configuration::all();
    }

    /**
     * Find an Attribute Query
     *
     * @return \AvoRed\Framework\Models\Database\Configuration
     */
    public function create($data)
    {
        return Configuration::create($data);
    }
}
