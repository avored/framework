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
     * @param string $key
     * @param \AvoRed\Framework\Widget\Widget $widget
     * @return \AvoRed\Framework\Widget\Widget $widget
     */
    public function make($key, $widget)
    {
        $this->collection->put($key, $widget);
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
        foreach ($this->collection as $key => $widget) {
            $options->put($key, $widget->label());
        }
        return $options;
    }
}
