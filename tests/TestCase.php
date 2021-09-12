<?php

namespace AvoRed\Framework\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use AvoRed\Framework\AvoRedServiceProvider;
use AvoRed\Framework\Database\Models\AdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Faker\Generator as FakerGenerator;
class TestCase extends Orchestra
{
    /**
     * Admin User.
     * @var \AvoRed\Framework\Database\Models\AdminUser
     */
    protected $user;

    protected $faker;


    /**
     * PHP Unit Test Setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = $this->app->make(FakerGenerator::class);
        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'AvoRed\\Framework\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
        $this->setUpDatabase();
        Notification::fake();
    }

    /**
     * Reset the Database.
     * @return void
     */
    private function resetDatabase(): void
    {
        $this->artisan('migrate');
    }

    /**
     * Setup database for the unit test.
     * @return void
     */
    protected function setUpDatabase(): void
    {
        $this->loadLaravelMigrations();
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
     * Undocumented function
     *
     * @param string $routeName
     * @return \Illuminate\Testing\TestResponse
     */
    public function getAvoRed($routeName): TestResponse
    {
        return $this->get(route($routeName));
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
        config()->set('database.default', 'testing');
    }

    /**
     * Create an Admin user model.
     * @param array $data
     * @return self
     */
    protected function createAdminUser($data = ['is_super_admin' => 1]): self
    {
        if (null === $this->user) {
            $this->user = AdminUser::factory()->create($data);
        }

        return $this;
    }
}
