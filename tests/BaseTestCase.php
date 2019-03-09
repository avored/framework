<?php
namespace AvoRed\Framework\Tests;

use AvoRed\Framework\Provider;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\AdminUser;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Database\Language;
use AvoRed\Framework\System\Middleware\LanguageMiddleware;
use AvoRed\Framework\Models\Contracts\LanguageInterface;

abstract class BaseTestCase extends OrchestraTestCase
{
    /**
     * Admin User 
     * @var \AvoRed\Framework\Models\Database\AdminUser $user
     */
    protected $user;

    /**
     * Default Language for the Framework
     * @var \AvoRed\Framework\Models\Database\Language
     */
    protected $defaultLanguage; 

    public function setUp()
    {
        parent::setUp();
        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
        $this->app['config']->set('app.url', env('APP_URL'));

        $this->app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            return EloquentFactory::construct($faker, __DIR__.('/../database/factories'));
        });
        $this->setUpDatabase();
        Notification::fake();
       
    }
    private function resetDatabase()
    {
        $this->artisan('migrate:fresh', [
            '--database' => 'sqlite',
        ]);

        Language::create(
            ['name' => 'English',
            'code' => 'en',
            'is_default' => 1]
        );

        $middleware = new LanguageMiddleware(app(LanguageInterface::class));

        $response = $middleware->handle(request(), function () {});
        $this->defaultLanguage = Session::get('default_language');
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
            $this->user = factory(AdminUser::class)->create(['is_super_admin' => 1]);
        }
        return $this->user;
    }

    /**
     * Set Admin User for UnitTest
     *
     * @return self
     */
    protected function adminuser()
    {
        if (null === $this->user) {    
            $this->user = factory(AdminUser::class)->create(['is_super_admin' => 1]);
        }
        return $this;
    }
}
