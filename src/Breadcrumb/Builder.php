<?php

namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\Collection;

class Builder
{
    /**
     * Breadcrumb Label.
     *  @var \AvoRed\Framework\Breadcrumb\Breadcrumb
     */
    protected $breadcrumb;

    /**
     * Breadcrumb Label.
     *  @var \Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * Breadcrumb Builder Construct.
     */
    public function __construct()
    {
        $this->collection = new Collection();
    }

    /**
     * Breadcrumb Make an Object.
     *
     * @param string $name
     * @param callable $callable
     * @return void
     */
    public function make($name, callable $callable)
    {
        $breadcrumb = new Breadcrumb($callable);
        $breadcrumb->route($name);

        $this->collection->put($name, $breadcrumb);
    }

    /**
     * Render BreakCrumb for the Route Name.
     *
     * @param string $routeName
     * @return string|\Illuminate\View\View
     */
    public function render($routeName)
    {
        $breadcrumb = $this->collection->get($routeName);

        if (null === $breadcrumb) {
            return '';
        }

        return view('avored::breadcrumb.index')
                ->with(compact('breadcrumb'));
    }

    /**
     * Get Breadcrum from collection.
     *
     * @param string $key
     * @return mixed $route
     */
    public function get($key)
    {
        return $this->collection->get($key);
    }
}
