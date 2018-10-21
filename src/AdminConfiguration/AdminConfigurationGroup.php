<?php

namespace AvoRed\Framework\AdminConfiguration;

use Illuminate\Support\Collection;

class AdminConfigurationGroup
{
    /**
     * @var string $label
     */
    protected $label;

    /**
     * @var \Illuminate\Support\Collection $groupList
     */
    public $groupList;

    /**
     * @var string $key
     */
    protected $key;

    public function __construct()
    {
        $this->groupList = Collection::make([]);
    }

    /**
     * Get/Set Label for Admin Configuration Group
     *
     * @param string|null $label
     * @return string|self $label|$this
     */
    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;

            return $this;
        }

        return $this->label;
    }

    /**
     * Get/Set Key for Admin Configuration Group
     *
     * @param string|null $key
     * @return string|self $key|$this
     */
    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;

            return $this;
        }

        return $this->key;
    }

    /**
     * Return all the group list
     *
     * @return \Illuminate\Support\Collection $groupList
     */
    public function all()
    {
        return $this->groupList;
    }

    /**
     * Add Configuration to the group list
     *
     * @param string $key
     * @return \AvoRed\Framework\AdminConfiguration\AdminConfiguration $adminConfiguration
     */
    public function addConfiguration($key)
    {
        $adminConfiguration = new AdminConfiguration();

        $adminConfiguration->key($key);
        $this->groupList->put($key, $adminConfiguration);

        return $adminConfiguration;
    }
}
