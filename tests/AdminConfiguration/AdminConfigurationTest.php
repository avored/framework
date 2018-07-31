<?php

namespace AvoRed\Framework\Tests\AdminConfiguration;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\AdminConfiguration\AdminConfigurationGroup;
use AvoRed\Framework\AdminConfiguration\AdminConfiguration;
use AvoRed\Framework\AdminConfiguration\Manager;

class AdminConfigurationTest extends BaseTestCase
{
    /**
     * Test to check if Builder can set the Admin Configuration Group Key
     *
     * @return void
     */
    public function test_admin_configuration_group_key()
    { 
        $group = new AdminConfigurationGroup();
        $group->key('test');

        $this->assertEquals($group->key(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Group Label
     *
     * @return void
     */
    public function test_admin_configuration_group_label()
    {
        $group = new AdminConfigurationGroup();
        $group->label('test');

        $this->assertEquals($group->label(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Group Add Configuration
     *
     * @return void
     */
    public function test_admin_configuration_group_add_configuration()
    {
        $group = new AdminConfigurationGroup();
        $configuration = $group->addConfiguration('test');

        $this->assertEquals($configuration->key(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Label
     *
     * @return void
     */
    public function test_admin_configuration_label()
    {
        $configuration = new AdminConfiguration();
        $configuration->label('test');

        $this->assertEquals($configuration->label(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Key
     *
     * @return void
     */
    public function test_admin_configuration_key()
    {
        $configuration = new AdminConfiguration();
        $configuration->key('test');

        $this->assertEquals($configuration->key(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Name
     *
     * @return void
     */
    public function test_admin_configuration_name()
    {
        $configuration = new AdminConfiguration();
        $configuration->name('test');

        $this->assertEquals($configuration->name(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Type
     *
     * @return void
     */
    public function test_admin_configuration_type()
    {
        $configuration = new AdminConfiguration();
        $configuration->type('test');

        $this->assertEquals($configuration->type(), 'test');
    }

    /**
     * Test to check if Builder can set the Admin Configuration Option
     *
     * @return void
     */
    public function test_admin_configuration_option()
    {
        $configuration = new AdminConfiguration();
        $configuration->options(function () {
            return 'test';
        });

        $this->assertEquals($configuration->options(), 'test');
    }

    /**
    * Test to check if manager can add the Admin Configuration
    *
    * @return void
    */
    public function test_admin_configuration_manager_add()
    {
        $configuration = new Manager();
        $configField = $configuration->add('test');

        $this->assertEquals($configField->key(), 'test');
    }

    /**
    * Test to check if manager can set the Admin Configuration group
    *
    * @return void
    */
    public function test_admin_configuration_manager_set()
    {
        $configuration = new Manager();
        $configField = $configuration->add('test');
        $configuration->set($configField->key(), $configField);

        $this->assertInstanceOf(AdminConfigurationGroup::class, $configuration->get('test'));
    }

    /**
    * Test to check if Manager  can get all the  Admin Configuration group
    *
    * @return void
    */
    public function test_admin_configuration_manager_all()
    {
        $configuration = new Manager();
        $configField1 = $configuration->add('test1');
        $configField2 = $configuration->add('test2');

        $allConfiguration = $configuration->all();
        $this->assertCount(2, $allConfiguration);
    }

    /**
    * Test to check if Manager  can get all the  Admin Configuration group
    *
    * @return void
    */
    public function test_admin_configuration_manager_get()
    {
        $configuration = new Manager();
        $configField = $configuration->add('test');
        $configuration->set($configField->key(), $configField);

        $getField = $configuration->get('test');
        $this->assertEquals($configField, $getField);
    }
}
