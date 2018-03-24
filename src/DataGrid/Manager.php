<?php

namespace AvoRed\Framework\DataGrid;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use AvoRed\Framework\DataGrid\Columns\LinkColumn;
use AvoRed\Framework\DataGrid\Columns\TextColumn;

class Manager
{
    /**
     * Database table model.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * DataGrid Collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $collection;

    /**
     * Database table model.
     *
     * @var \Illuminate\Support\Collection
     */
    public $data;
    /**
     * Database table model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;
    /**
     * Database table model.
     *
     * @var \Illuminate\Support\Collection
     */
    public $columns = null;
    /**
     * Database table model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $pageItem = 10;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->columns = new Collection();
        $this->collection = new Collection();
    }

    /**
     * Breadcrumb Make an Object.
     *
     * @param string $name
     * @param callable $callable
     * @return void
     */
    public function make($name):DataGrid
    {
        $dataGrid = new DataGrid($this->request);
        $this->collection->put($name, $dataGrid);

        return $dataGrid;
    }

    public function setPagination($item = 10)
    {
        $this->pageItem = $item;
    }

    public function render($dataGrid)
    {
        if (null !== $this->request->get('asc')) {
            $dataGrid->model->orderBy($this->request->get('asc'), 'asc');
        }
        if (null !== $this->request->get('desc')) {
            $dataGrid->model->orderBy($this->request->get('desc'), 'desc');
        }

        $dataGrid->data = $dataGrid->model->paginate($this->pageItem);

        return view('avored-framework::datagrid.grid')->with('dataGrid', $dataGrid);
    }

    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    public function column($identifier, $options = [])
    {
        $column = new TextColumn($identifier, $options);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function linkColumn($identifier, $options, $callback)
    {
        $column = new LinkColumn($identifier, $options, $callback);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function dataTableData($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return static
     */
    public function get()
    {
        $count = $this->model->get()->count();

        $columns = $this->request->get('columns');

        $orders = $this->request->get('order');

        $order = $orders[0];

        $records = $this->model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');

        $records->skip($noOfSkipRecord)->take($noOfRecord);

        $allRecords = $records->get();

        if (isset($this->columns) && $this->columns->count() > 0) {
            $jsonRecords = Collection::make([]);

            foreach ($allRecords as $i => $singleRecord) {
                foreach ($this->columns as $key => $columnData) {
                    if (is_callable($columnData)) {
                        $columnValue = $columnData($singleRecord);
                    } else {
                        $columnValue = $columnData;
                    }

                    $singleRecord->setAttribute($key, $columnValue);
                }

                $jsonRecords->put($i, $singleRecord);
            }
        }

        $data = [
            'data' => (isset($jsonRecords)) ? $jsonRecords : $allRecords,
            'draw' =>  $this->request->get('draw'),
            'recordsTotal'=> $count,
            'recordsFiltered' => $count,
        ];

        return JsonResponse::create($data);
    }

    public function addColumn($columnKey, $data)
    {
        if (null === $this->columns) {
            $this->columns = Collection::make([]);
        }
        $this->columns->put($columnKey, $data);

        return $this;
    }
}
