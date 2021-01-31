<?php

namespace AvoRed\Framework\Tests;

use AvoRed\Framework\AvoRedProvider;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\Facades\Notification;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Models\Currency;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class BaseTestCase extends OrchestraTestCase
{
    /**
     * Admin User.
     * @var \AvoRed\Framework\Database\Models\AdminUser
     */
    protected $user;

    protected $faker;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->faker = $this->app->make(FakerGenerator::class);

        $this->withFactories(__DIR__ . '/../database/factories');

        $this->setUpDatabase();
        $this->setDefaultCurrency();
        Notification::fake();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
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
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            AvoRedProvider::class,
        ];
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

    protected function setDefaultCurrency()
    {
        factory(Currency::class)->create();
        $currencyRepository = app(CurrencyModelInterface::class);
        $currency = $currencyRepository->all()->first();
        $this->withSession(['default_currency' => $currency]);
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
            'Breadcrumb' => \AvoRed\Framework\Support\Facades\Breadcrumb::class,
            'Menu' => \AvoRed\Framework\Support\Facades\Menu::class,
            'Module' => \AvoRed\Framework\Support\Facades\Module::class,
            'Permission' => \AvoRed\Framework\Support\Facades\Permission::class,
            'Cart' => \AvoRed\Framework\Support\Facades\Cart::class,
            'Payment' => \AvoRed\Framework\Support\Facades\Payment::class,
            'Shipping' => \AvoRed\Framework\Support\Facades\Shipping::class,
            'Tab' => \AvoRed\Framework\Support\Facades\Tab::class,
            'Widget' => \AvoRed\Framework\Support\Facades\Widget::class,
            'Asset' => \AvoRed\Assets\Support\Facades\Asset::class
        ];
    }

    /**
     * Create an Admin user model.
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
