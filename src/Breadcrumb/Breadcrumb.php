<?php

namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\Collection;
use AvoRed\Framework\Support\Facades\Breadcrumb as BreadcrumbFacade;
use AvoRed\Framework\Support\Contracts\BreadcrumbInterface;

class Breadcrumb implements BreadcrumbInterface
{
    /**
     * Breadcrumb Label.
     *  @var string
     */
    public $label = null;

    /**
     * Breadcrumb Route.
     *  @var string
     */
    public $route = null;

    /**
     * Breadcrumb Route Parents.
     *  @var string
     */
    public $parents = null;

    /**
     * Breadcrumb Callable.
     *  @var callable
     */
    protected $callable = null;

    /**
     *  AvoRed BreakCrumb Construct method.
     * @param callable $callable
     */
    public function __construct($callable)
    {
        $this->callback = $callable;
        $this->parents = new Collection();

        $callable($this);
    }

    /**
     *  Get/Set AvoRed BreakCrumb Label.
     *
     * @var string|null
     * @return \AvoRed\Framework\Breadcrumb\Breadcrumb|string
     */
    public function label($label = null)
    {
        if (null === $label) {
            return $this->label;
        }
        $this->label = $label;

        return $this;
    }

    /**
     *  Get/Set AvoRed BreakCrumb Route.
     *
     * @var string|null
     * @return \AvoRed\Framework\Breadcrumb\Breadcrumb|string
     */
    public function route($route = null)
    {
        if (null === $route) {
            return $this->route;
        }
        $this->route = $route;

        return $this;
    }

    /**
     *  Set AvoRed BreakCrumb Parents.
     *
     * @var string
     * @return \AvoRed\Framework\Breadcrumb\Breadcrumb
     */
    public function parent($key):self
    {
        $breadcrumb = BreadcrumbFacade::get($key);
        $this->parents->put($key, $breadcrumb);

        return $this;
    }
}
