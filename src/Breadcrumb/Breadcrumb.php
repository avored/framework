<?php
namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\Collection;
use AvoRed\Framework\Breadcrumb\Contracts\Breadcrumb as BreadcrumbContracts;
use AvoRed\Framework\Breadcrumb\Breadcrumb;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;


class Breadcrumb implements BreadcrumbContracts
{

    /**
    * Breadcrumb Label
    *  @var $label
    */
    public $label = null;

    /**
    * Breadcrumb Route
    *  @var $route
    */
    public $route = null;

    /**
    * Breadcrumb Route Parents
    *  @var $parents
    */
    public $parents = null;


    /**
    * Breadcrumb Callable
    *  @var $callable
    */
    protected $callable = null;

    /**
    *  AvoRed BreakCrumb Construct method
    *
    */
    public function __construct($callable)
    {
        $this->callback = $callable;
        $this->parents  = new Collection();

        $callable($this);
    }

    /**
    *  Get/Set AvoRed BreakCrumb Label
    *
    * @var string|NULL
    * @return \AvoRed\Framework\Breadcrumb\Breadcrumb|string
    */
    public function label($label = NULL) {

        if(null === $label) {
            return $this->label;
        }
        $this->label = $label;
        return $this;
    }


    /**
    *  Get/Set AvoRed BreakCrumb Route
    *
    * @var string|NULL
    * @return \AvoRed\Framework\Breadcrumb\Breadcrumb|string
    */
    public function route($route = NULL) {

        if(null === $route) {
            return $this->route;
        }
        $this->route = $route;

        return $this;
    }


    /**
    *  Set AvoRed BreakCrumb Parents
    *
    * @var string $key
    * @return \AvoRed\Framework\Breadcrumb\Breadcrumb
    */
    public function parent($key):Breadcrumb {
        $breadcrumb = BreadcrumbFacade::get($key);
        $this->parents->put($key, $breadcrumb);

        return $this;
    }
}
