<?php
namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\Collection;

class Builder
{

    protected $breadcrumb;


    protected $collection;


    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    public function make($name, callable  $callable) {

        $breadcrumb = new Breadcrumb($callable);
        $breadcrumb->route($name);

        $this->collection->put($name, $breadcrumb);
    }

    public function render($routeName) {

        $breadcrumb = $this->collection->get($routeName);

        if(null === $breadcrumb) {
            return "";
        }
        return view('avored-framework::breadcrumb.index')->with('breadcrumb', $breadcrumb);
    }

    public function get($key) {
        return $this->collection->get($key);
    }
}
