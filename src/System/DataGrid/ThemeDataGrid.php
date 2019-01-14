<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class ThemeDataGrid
{
    /**
     * Theme DataGrid Manager
     *
     * @var \AvoRed\Framework\DataGrid\Manager $dataGrid
     */
    public $dataGrid;

    /**
     * Theme controller which accepts Collection of themes and Currently Active Theme.
     *
     * @param \ Illuminate\Database\Eloquent\Collection $themeCollection
     * @param string $activeTheme
     */
    public function __construct($model, $activeTheme)
    {
        $dataGrid = DataGrid::make('admin_theme_controller');

        $dataGrid->model($model)
                ->column('name', ['label' => 'Name'])
                ->column('identifier', ['label' => 'Identifier'])
                ->linkColumn('is_active', ['label' => 'Is Active'], function ($model) use ($activeTheme) {
                    if ($model['identifier'] == $activeTheme) {
                        return 'Yes';
                    }
                    return 'No';
                })
                ->linkColumn('activate_route', ['label' => 'Action'], function ($model) use ($activeTheme) {
                    if ($model['identifier'] != $activeTheme) {
                        return '<form action="' . route('admin.theme.activated', $model['identifier']) . '" 
                                        method="post">
                                ' . csrf_field() . '
                                <button class="btn btn-primary" type="submit">
                                    Activate
                                </button>
                                </form>
                                ';
                    } else {
                        return '<button href="#" class="btn disabled">Activated</button>';
                    }
                });

        $this->dataGrid = $dataGrid;
    }
}
