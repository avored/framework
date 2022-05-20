<?php

namespace AvoRed\Framework\Tab;

use Illuminate\Support\Collection;

class Manager
{
    /**
     * Tab collection.
     * @var \Illuminate\Support\Collection
     */
    public $collection;

    /**
     * Construct for the Tab Manager.
     */
    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    /**
     * Get all the Tab Options Collection.
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->collection;
    }

    /**
     * Get all the Tab Options Collection.
     * @param string $key
     * @return \Illuminate\Support\Collection
     */
    public function get(string $key): Collection
    {
        return $this->collection->get($key);
    }

    /**
     * Put Tab class to an collection Collection.
     * @param string $key
     * @param callable $tab
     * @return self
     */
    public function put(string $key, callable $tab)
    {
        $tabObject = new TabItem($tab);
        if (! $this->collection->has($key)) {
            $collection = Collection::make([]);
            $collection->push($tabObject);
        } else {
            $collection = $this->collection->get($key);
            $collection->push($tabObject);
        }
        $this->collection->put($key, $collection);

        return $this;
    }
}
