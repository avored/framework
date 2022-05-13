<?php
namespace AvoRed\Framework\Tests;

use Orchestra\Testbench\TestCase;
use AvoRed\Framework\AvoRedServiceProvider;
use Illuminate\Support\Facades\Notification;
use Faker\Generator as FakerGenerator;

class AvoRedBaseTestCase extends TestCase
{
    protected $faker;

    protected $loadEnvironmentVariables = true;

    /**
     * PHP Unit Test Setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = $this->app->make(FakerGenerator::class);
        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'AvoRed\\Framework\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        // );
        $this->setUpDatabase();
        Notification::fake();
    }

    /**
     * Reset the Database.
     * @return void
     */
    private function resetDatabase(): void
    {
        $this->artisan('migrate:fresh');
    }

    /**
     * Setup database for the unit test.
     * @return void
     */
    protected function setUpDatabase(): void
    {
        // $this->loadLaravelMigrations();
        $this->resetDatabase();
    }

    /**
     * Undocumented function
     *
     * @param Application $app
     * @return void
     */
    protected function getPackageProviders($app)
    {
        return [
            AvoRedServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        return [
            // 'Breadcrumb' => \AvoRed\Framework\Breadcrumb\Breadcrumb::class,
            // 'Menu' => \AvoRed\Framework\Menu\Menu::class,
            // 'Payment' => \AvoRed\Framework\Payment\Payment::class,
            // 'Permission' => \AvoRed\Framework\Permission\Permission::class,
            // 'Shipping' => \AvoRed\Framework\Shipping\Shipping::class,
        ];
    }

    /**
     * Undocumented function
     *
     * @param Application $app
     * @return void
     */
    public function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
    }
}
