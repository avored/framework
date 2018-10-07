<?php

namespace AvoRed\Framework\DataGrid;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use AvoRed\Framework\DataGrid\Columns\LinkColumn;
use AvoRed\Framework\DataGrid\Columns\TextColumn;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
     *  Page Name
     * @var string $pageName
     */
    public $pageName = 'page';

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
     * DataGrid Make an Object.
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
        if (null !== $this->request->get('q')) {
            foreach ($this->request->get('q') as $key => $val) {
                $dataGrid->model->where($key, 'like', '%' . $val . '%');
            }
        }

        $options = ['path' => asset(request()->path())];

        if (!$dataGrid->model instanceof Collection) {
            if (null !== $this->request->get('asc')) {
                $dataGrid->model->orderBy($this->request->get('asc'), 'asc');
            }
            if (null !== $this->request->get('desc', 'id')) {
                $dataGrid->model->orderBy($this->request->get('desc', 'id'), 'desc');
            }
            $dataGrid->data = $dataGrid->model->paginate($this->pageItem, ['*'], $dataGrid->pageName());
        } else {
            $dataGrid->data = $this->paginate($dataGrid->model, $this->pageItem, null, $options);
        }

        return view('avored-framework::datagrid.grid')->with('dataGrid', $dataGrid);
    }

    /**
     * Set the model or Collection for the DataGrid Data
     *
     * @param mixed $model
     * @return self
     */
    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Gera a paginação dos itens de um array ou collection.
    *
    * @param array|Collection      $items
    * @param int   $perPage
    * @param int  $page
    * @param array $options
    *
    * @return LengthAwarePaginator
    */
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(
                        $items->forPage($page, $perPage),
                        $items->count(),
                        $perPage,
                        $page,
                        $options
        );
    }

    public function column($identifier, $options = [])
    {
        $column = new TextColumn($identifier, $options);

        $this->columns->put($identifier, $column);

        return $this;
    }

    public function linkColumn($identifier, $options = [], $callback)
    {
        $column = new LinkColumn($identifier, $options, $callback);
        $this->columns->put($identifier, $column);

        return $this;
    }

    /*
    public function dataTableData($model)
    {
        $this->model = $model;

        return $this;
    }


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
            'draw' => $this->request->get('draw'),
            'recordsTotal' => $count,
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

    /**
     *
     *
     * @param null|string $pageName
     */
    public function pageName($pageName = null)
    {
        if (null === $pageName) {
            return $this->pageName;
        }

        $this->pageName = $pageName;

        return $this;
    }
}
