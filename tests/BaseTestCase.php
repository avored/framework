<?php
namespace AvoRed\Framework\Tests;

use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Models\AdminUser;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\AvoRedProvider;
use Rebing\GraphQL\GraphQLServiceProvider;

//use AvoRed\Framework\Models\Database\Language;
//use AvoRed\Framework\System\Middleware\LanguageMiddleware;
//use AvoRed\Framework\Models\Contracts\LanguageInterface;

abstract class BaseTestCase extends OrchestraTestCase
{
    /**
     * Admin User
     * @var \AvoRed\Framework\Database\Models\AdminUser $user
     */
    protected $user;

    /**
     * Setup Config and other data for unit test
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
        
        $this->app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            return EloquentFactory::construct($faker, __DIR__.('/../database/factories'));
        });
        $this->setUpDatabase();
        Notification::fake();
    }

    /**
     * Reset the Database
     * @return void
     */
    private function resetDatabase(): void
    {
        $this->artisan('migrate:fresh', [
            '--database' => 'sqlite',
        ]);

        /*
        Language::create(
            ['name' => 'English',
            'code' => 'en',
            'is_default' => 1]
        );
        $middleware = new LanguageMiddleware(app(LanguageInterface::class));
        $this->defaultLanguage = Session::get('default_language');
        */
    }

    /**
     * Returns the array with unittest required package
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            GraphQLServiceProvider::class,
            AvoRedProvider::class,
        ];
    }

    /**
     * Set up the environment.
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', array(
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ));
    }

    /**
     * Setup sqlite database for the unit test
     * @return void
     */
    protected function setUpDatabase(): void
    {
        $this->resetDatabase();
    }

    /**
     * Setup sqlite database for the unit test
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        return [
            //'AdminMenu' => 'AvoRed\\Framework\\AdminMenu\\Facade',
            //'AdminConfiguration' => 'AvoRed\\Framework\\AdminConfiguration\\Facade',
            //'Breadcrumb' => 'AvoRed\\Framework\\Breadcrumb\\Facade',
            //'Cart' => 'AvoRed\\Framework\\Cart\\Facade',
            //'DataGrid' => 'AvoRed\\Framework\\DataGrid\\Facade',
            //'Image' => 'AvoRed\\Framework\\Image\\Facade',
            'Menu' => \AvoRed\Framework\Support\Facades\Menu::class,
            'Module' => \AvoRed\Framework\Support\Facades\Module::class,
            'GraphQL' => \Rebing\GraphQL\Support\Facades\GraphQL::class,
            //'Payment' => 'AvoRed\\Framework\\Payment\\Facade',
            //'Permission' => 'AvoRed\\Framework\\Permission\\Facade',
            //'Shipping' => 'AvoRed\\Framework\\Shipping\\Facade',
            //'Tabs' => 'AvoRed\\Framework\\Tabs\\Facade',
            //'Theme' => 'AvoRed\\Framework\\Theme\\Facade',
            //'Widget' => 'AvoRed\\Framework\\Widget\\Facade'
        ];
    }

    /**
     * Get Admin User Object for unit test
     * @param array $data
     * @return self
     */
    protected function createAdminUser($data = ['is_super_admin' => 1]): self
    {
        if (null === $this->user) {
            $this->user = factory(AdminUser::class)->create($data);
        }
        return $this;
    }
}
