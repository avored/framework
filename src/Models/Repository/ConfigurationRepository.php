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
