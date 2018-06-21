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
     * @var array $groupList
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

    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;

            return $this;
        }

        return $this->label;
    }

    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;

            return $this;
        }

        return $this->key;
    }

    public function all()
    {
        return $this->groupList;
    }

    public function addConfiguration($key = null)
    {
        $adminConfiguration = new AdminConfiguration();

        $adminConfiguration->key($key);
        $this->groupList->put($key, $adminConfiguration);

        return $adminConfiguration;
    }
}
