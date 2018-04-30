<?php

namespace AvoRed\Framework\AdminConfiguration;

use Illuminate\Support\Collection;

class Manager
{
    /**
     * Collect all the Permissions from all the modules.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $permissions;

    public function __construct()
    {
        $this->configurations = Collection::make([]);
    }

    public function all()
    {
        return $this->configurations;
    }

    /**
     * Add Permission Array into Collection.
     *
     * @param string $key
     * @return \AvoRed\Framework\Permission\Manager
     */
    public function add($key)
    {
        $configuration = new AdminConfigurationGroup();

        $configuration->key($key);
        $this->configurations->put($key, $configuration);

        return $configuration;
    }

    /**
     * Get Permission Collection if exists or Return Empty Collection.
     *
     * @param array $item
     * @return \Illuminate\Support\Collection
     */
    public function get($key)
    {
        if ($this->configurations->has($key)) {
            return $this->configurations->get($key);
        }

        return $collection = Collection::make([]);
    }

    /**
     * Get Permission Collection if exists or Return Empty Collection.
     *
     * @param array $item
     * @return \Illuminate\Support\Collection
     */
    public function set($key, $configurationCollection)
    {

        //dd($configurationCollection);
        $this->configurations->put($key, $configurationCollection);

        return $this;
    }
}
