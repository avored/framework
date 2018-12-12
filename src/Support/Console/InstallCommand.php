<?php

namespace AvoRed\Framework\Support\Console;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Theme\Facade as Theme;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:install';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install AvoRed e commerce an Laravel Shopping Cart';

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
            $this->dropAllTables();

            $answer = $this->ask('Deseja instalar produtos Demo? (s/n)', 'yes');

        if (in_array($answer, ['y', 'yes', 'sim', 's'])) {
            $this->call('key:generate');
            $this->call('migrate');
            $this->call('db:seed', ['--class' => 'AvoRedDataSeeder']);
            $this->call('vendor:publish', ['--tag' => 'public']);
            if (!file_exists(public_path('storage'))) {
                $this->call('storage:link');
            }
        } else {
            $this->call('key:generate');
            $this->call('migrate');
        }

            // THEME PUBLISH
            $theme = Theme::get('avored-default');
            $fromPath = $theme['asset_path'];
            $toPath = public_path('vendor/' . $theme['identifier']);
            Theme::publishItem($fromPath, $toPath);
            $this->call('passport:install');
            $this->call('passport:keys');

            $configurationRepository = app(ConfigurationInterface::class);
            
            Configuration::create(
                ['configuration_key' => 'active_theme_identifier',
                'configuration_value' => 'avored-default']
            );
            Configuration::create(
                ['configuration_key' => 'active_theme_path',
                'configuration_value' => base_path('themes\avored\default')]
            );
            Configuration::create(
                ['configuration_key' => 'avored_catalog_no_of_product_category_page',
                'configuration_value' => 9]
            );
            Configuration::create(
                ['configuration_key' => 'avored_catalog_cart_page_display_taxamount',
                    'configuration_value' => 'no']
            );
            Configuration::create(
                ['configuration_key' => 'avored_tax_class_percentage_of_tax',
                'configuration_value' => 0]
            );
            $this->info('Plataforma instalada com sucesso!');
    }

    /**
     * Drop all of the database tables.
     *
     * @return void
     */
    public function dropAllTables()
    {
        $this->laravel['db']->connection()
            ->getSchemaBuilder()
            ->dropAllTables();
    }
}
