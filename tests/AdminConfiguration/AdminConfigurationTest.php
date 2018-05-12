<?php

namespace AvoRed\Framework\Tests\AdminConfiguration;

use PHPUnit\Framework\TestCase;
use AvoRed\Framework\AdminConfiguration\AdminConfigurationGroup;
use AvoRed\Framework\AdminConfiguration\AdminConfiguration;

class AdminConfigurationTest extends TestCase
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
        $configuration->options('test');
        
        $this->assertEquals($configuration->options(), 'test');
    }
    
    
}


