<?php

namespace AvoRed\Framework\Tests\DataGrid;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\DataGrid\Manager;
use AvoRed\Framework\DataGrid\DataGrid;

class DataGridTest extends BaseTestCase
{
    /**
     * Test to check if Datagrid Manager make return datagrid instance
     *
     * @return void
     */
    public function test_datagrid_manager_make()
    {
        $manager = new Manager(request());

        $dataGrid = $manager->make('test_name');

        $this->assertInstanceOf(DataGrid::class, $dataGrid);
    }

    /**
     * Test to check if Datagrid Manager column method
     *
     * @return void
     */
    public function test_datagrid_manager_column()
    {
        $manager = new Manager(request());
        $manager->column('column_name_1');
        $manager->linkColumn('column_name_2', [], function () {
            return 'test';
        });

        $this->assertEquals(2, count($manager->columns));
    }
}
