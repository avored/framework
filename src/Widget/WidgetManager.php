<?php
namespace AvoRed\Framework\Widget;

use Illuminate\Support\Collection;

class WidgetManager
{
    /**
     * Collection of Widget
     * @var object \Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * Construct for the Widget manager
     * @return void
     */
    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    /**
     * Add Widget Class to a collection
     * @param string $name
     * @param \AvoRed\Framework\Widget\Widget $widget
     * @return \AvoRed\Framework\Widget\Widget $widget
     */
    public function make($name, $widget)
    {
        $this->collection->put($name, $widget);
        return $widget;
    }

    /**
     * Get the Widget from collection by given key
     * @param string $key
     * @return \AvoRed\Framework\Widget\Widget $widget
     */
    public function get($key)
    {
        return $this->collection->get($key);
    }

    /**
     * Returns All the widget in collection
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->collection;
    }

    /**
     * Returns All the widget in options to use as dropdown
     * @return \Illuminate\Support\Collection
     */
    public function options(): Collection
    {
        $options = Collection::make([]);
        foreach ($this->collection as $identifier => $widget) {
            $options->put($identifier, $widget->label());
        }
        return $options;
    }
}
