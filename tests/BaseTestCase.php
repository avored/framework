<?php
namespace AvoRed\Framework\Tests;

use AvoRed\Framework\Provider;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\AdminUser;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Generator as FakerGenerator;

abstract class BaseTestCase extends OrchestraTestCase
{
    /**
     * Admin User 
     * @var \AvoRed\Framework\Models\Database\AdminUser $user
     */
    protected $user; 

    public function setUp()
    {
        parent::setUp();
        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
      
        $this->app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            return EloquentFactory::construct($faker, __DIR__.('/../database/factories'));
        });
        $this->setUpDatabase();
       
    }
    private function resetDatabase()
    {
        $this->artisan('migrate:fresh', [
            '--database' => 'sqlite',
        ]);
    }
    protected function getPackageProviders($app)
    {
        return [
            Provider::class,
        ];
    }
    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', array(
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ));
       
    }
    protected function setUpDatabase()
    {
        $this->resetDatabase();
    }

    protected function getPackageAliases($app)
    {
        return [
            'AdminMenu' => 'AvoRed\\Framework\\AdminMenu\\Facade',
            'AdminConfiguration' => 'AvoRed\\Framework\\AdminConfiguration\\Facade',
            'Breadcrumb' => 'AvoRed\\Framework\\Breadcrumb\\Facade',
            'Cart' => 'AvoRed\\Framework\\Cart\\Facade',
            'DataGrid' => 'AvoRed\\Framework\\DataGrid\\Facade',
            'Image' => 'AvoRed\\Framework\\Image\\Facade',
            'Menu' => 'AvoRed\\Framework\\Menu\\Facade',
            'Payment' => 'AvoRed\\Framework\\Payment\\Facade',
            'Permission' => 'AvoRed\\Framework\\Permission\\Facade',
            'Shipping' => 'AvoRed\\Framework\\Shipping\\Facade',
            'Tabs' => 'AvoRed\\Framework\\Tabs\\Facade',
            'Theme' => 'AvoRed\\Framework\\Theme\\Facade',
            'Widget' => 'AvoRed\\Framework\\Widget\\Facade'
        ];
    }


    /**
     * Get Admin User Object for unit test
     *
     * @return \AvoRed\Framework\Models\Database\AdminUser
     */
    protected function _getAdminUser()
    {
        if (null === $this->user) {
            $role = Role::create(['name' => 'Administrator', 'description' => 'Administrator']);
            $this->user = AdminUser::create(['role_id' => $role->id,
                                            'is_super_admin' => 1,
                                            'first_name' => 'Purvesh',
                                            'last_name' => 'Patel',
                                            'email' => 'admin@admin.com',
                                            'password' => bcrypt('admin123')
                                        ]);
        }
        return $this->user;
    }
}
