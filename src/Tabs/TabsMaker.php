<?php

namespace AvoRed\Framework\Tabs;

use Illuminate\Support\Collection;

class TabsMaker
{
    /**
     * Tabs Collection.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $adminTabs;

    /**
     * Tabs Construct.
     */
    public function __construct()
    {
        $this->adminTabs = Collection::make([]);
    }

    /**
     * Add Tab to Tabs Collection.
     *
     * @var string
     * @return $this
     */
    public function add($key, $tab)
    {
        $this->adminTabs->put($key, $tab);

        return $this;
    }

    /**
     * Get Tab from Tabs Collection.
     *
     * @var string
     * @return \AvoRed\Framework\Tabs\Tab
     */
    public function get($key)
    {
        $tab = $this->adminTabs->get($key);

        if (null == $tab) {
            throw new \Exception('Required Tab is missing');
        }
        return $this->adminTabs->get($key);
    }

    /**
     * Return all registered Tab with Specified Type.
     *
     * @var string
     * @return \Illuminate\Support\Collection
     */
    public function all($type = 'product')
    {
        $tabs = $this->adminTabs->filter(function ($item, $key) use ($type) {
            if ($item->type() == $type) {
                return true;
            }
        });

        return $tabs;
    }
}
