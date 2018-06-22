<?php

namespace AvoRed\Framework\Tests\Permission;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Permission\Manager;
use AvoRed\Framework\Permission\PermissionGroup;
use AvoRed\Framework\Permission\Permission;

class PermissionTest extends BaseTestCase
{
    /**
     * Test to check if Permission Manager add
     *
     */
    public function test_permission_manager_add()
    {
        $manager = new Manager();
        $group = $manager->add('test');

        $this->assertInstanceOf(PermissionGroup::class, $group);
    }

    /**
    * Test to check if Permission Manager get
    *
    */
    public function test_permission_manager_get()
    {
        $manager = new Manager();
        $group = $manager->add('test');

        $this->assertInstanceOf(get_class($group), $manager->get('test'));
    }

    /**
    * Test to check if Permission Manager set
    *
    */
    public function test_permission_manager_set()
    {
        $manager = new Manager();

        $group = $manager->add('test');

        $this->assertEquals('test', $manager->get('test')->key());
    }

    /**
    * Test to check if Permission group label
    *
    */
    public function test_permission_group_label()
    {
        $manager = new Manager();

        $group = $manager->add('test');
        $group->label('label');

        $manager->set('test', $group);

        $this->assertEquals('label', $manager->get('test')->label());
    }

    /**
    * Test to check if Permission  group add Permission
    *
    */
    public function test_permission_group_add_permission()
    {
        $manager = new Manager();

        $group = $manager->add('test');
        $permission = $group->addPermission('permission_key');

        $this->assertInstanceOf(Permission::class, $permission);
    }

    /**
    * Test to check if Permission label
    *
    */
    public function test_permission_label()
    {
        $manager = new Manager();

        $group = $manager->add('test');
        $permission = $group->addPermission('permission_key');
        $permission->label('label');

        $this->assertEquals('label', $permission->label());
    }

    /**
    * Test to check if Permission key
    *
    */
    public function test_permission_key()
    {
        $manager = new Manager();

        $group = $manager->add('test');
        $permission = $group->addPermission('permission_key');
        $permission->key('key');

        $this->assertEquals('key', $permission->key());
    }

    /**
    * Test to check if Permission key
    *
    */
    public function test_permission_routes()
    {
        $manager = new Manager();

        $group = $manager->add('test');
        $permission = $group->addPermission('permission_key');
        $permission->routes(['route1', 'route2']);

        $this->assertCount(2, $permission->routes());
    }
}
