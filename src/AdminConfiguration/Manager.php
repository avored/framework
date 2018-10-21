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
    protected $configurations;

    public function __construct()
    {
        $this->configurations = Collection::make([]);
    }

    /**
     * returns all existing configurations
     *
     * @return \Illuminate\Support\Collection $configurations
     */
    public function all()
    {
        return $this->configurations;
    }

    /**
     * Add Admin Configuration into Collection.
     *
     * @param string $key
     * @return \AvoRed\Framework\AdminConfiguration\AdminConfigurationGroup
     */
    public function add($key)
    {
        $configuration = new AdminConfigurationGroup();

        $configuration->key($key);
        $this->configurations->put($key, $configuration);

        return $configuration;
    }

    /**
     * Get Admin Configuration Collection if exists or Return Empty Collection.
     *
     * @param array $item
     * @return mixed \AvoRed\Framework\AdminConfiguration\AdminConfigurationGroup|\Illuminate\Support\Collection
     */
    public function get($key)
    {
        if ($this->configurations->has($key)) {
            return $this->configurations->get($key);
        }

        return Collection::make([]);
    }

    /**
     * Set the Configuration collection and return self
     *
     * @param array $item
     * @return \AvoRed\Framework\AdminConfiguration\Manager
     */
    public function set($key, $configurationCollection)
    {
        $this->configurations->put($key, $configurationCollection);

        return $this;
    }
}
