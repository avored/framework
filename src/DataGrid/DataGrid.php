<?php

namespace AvoRed\Framework\DataGrid;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use AvoRed\Framework\DataGrid\Columns\LinkColumn;
use AvoRed\Framework\DataGrid\Columns\TextColumn;

class DataGrid
{
    /**
     * Set the DataGrid Request.
     *
     * @var Illuminate\Http\Request;
     */
    public $request;

    /**
     * Set the DataGrid Database Model.
     * @var
     */
    public $model;

    /**
     * DataGrid Columns Collection.
     * @var/Support/Collection $columns
     */
    public $columns;

    public function __construct(Request $request)
    {
        $this->columns = new Collection();
        $this->request = $request;
    }

    /**
     * Set the DataGrid Database Model.
     *
     * @param mixed $model
     * @return \AvoRed\Framework\DataGrid\DataGrid $this;
     */
    public function model($model):self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Add Text Columns to the DataGrid Columns.
     *
     * @param string $identifier
     * @param array $options
     * @return \AvoRed\Framework\DataGrid\DataGrid $this;
     */
    public function column($identifier, $options = []):self
    {
        $column = new TextColumn($identifier, $options);
        $this->columns->put($identifier, $column);

        return $this;
    }

    /**
     * Add Link Columns to the DataGrid Columns.
     *
     * @param string $identifier
     * @param array $options
     * @param callback $callback
     * @return \AvoRed\Framework\DataGrid\DataGrid $this;
     */
    public function linkColumn($identifier, $options, $callback):self
    {
        $column = new LinkColumn($identifier, $options, $callback);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function asc($identifier = '')
    {
        return null !== $this->request->get('asc') && $this->request->get('asc') == $identifier;
    }

    public function desc($identifier = '')
    {
        return null !== $this->request->get('desc') && $this->request->get('desc') == $identifier;
    }
}
