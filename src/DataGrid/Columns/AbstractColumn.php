<?php

namespace AvoRed\Framework\DataGrid\Columns;

use AvoRed\Framework\DataGrid\Contracts\Column as ColumnContract;

abstract class AbstractColumn implements ColumnContract
{
    /**
     * Column Identifier.
     * @var null|string
     */
    protected $identifier = null;

    /**
     * Column Class.
     * @var null|string
     */
    protected $class = 'col';

    /**
     * Column Label.
     * @var null|string
     */
    protected $label = null;

    /**
     * Column Can Filter.
     * @var false|boolean
     */
    protected $canFilter = false;

    /**
     * Is Column Sortable?
     * @var null|string
     */
    protected $sortable = null;

    /**
     * @param string $identifier
     * @param array $options
     */
    public function __construct($identifier, $options)
    {
        if (is_callable($options)) {
            $options($this);
        } else {
            $this->identifier = $identifier;
            $this->label = $options['label'] ?? title_case($identifier);
            $this->sortable = $options['sortable'] ?? false;
        }
    }

    /**
     * Get the Column Type.
     * @return string $type
     */
    public function sortable($order = null)
    {
        if (null === $order) {
            return $this->sortable;
        }

        $this->sortable = $order;
        return $this;
    }

    /**
     * Get the Column Type.
     * @return string $type
     */
    public function type($type = null)
    {
        if (null === $type) {
            return $this->type;
        }

        $this->type = $type;
        return $this;
    }

    /**
     * get/set if column can filter ?.
     * @return string $type
     */
    public function canFilter($canFilter = null)
    {
        if (null === $canFilter) {
            return $this->canFilter;
        }

        $this->canFilter = $canFilter;
        return $this;
    }

    /**
     * Get the Column Label.
     * @return string $label
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
     * Get the column identifier.
     * @return string $identifier
     */
    public function identifier($identifier = null)
    {
        if (null === $identifier) {
            return $this->identifier;
        }

        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Get the column Class.
     * @return string $class
     */
    public function class($class = null)
    {
        if (null === $class) {
            return $this->class;
        }

        $this->class = $class;
        return $this;
    }
}
