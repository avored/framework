<?php

namespace AvoRed\Framework\Modules\Console;

use Illuminate\Console\Command;
use AvoRed\Framework\Support\Facades\Module;
use Illuminate\Database\Migrations\Migrator;

class ModuleInstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'avored:module:install {identifier}';

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
    protected $description = 'Install a module';

   
    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * Create a new migration command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator  $migrator
     * @return void
     */
    public function __construct(Migrator $migrator)
    {
        parent::__construct();

        $this->migrator = $migrator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $identifier = strtolower($this->getIdentifierInput());
        $module = Module::get($identifier);
        $provider = $module->namespace().'Module';
        $this->call('vendor:publish', ['--provider' => $provider]);
        $path = $module->basePath().DIRECTORY_SEPARATOR.'database/migrations';
        $this->migrator->run($path);

        $this->info('Module:'.$module->name().' has been installed successfully.');
    }

    /**
     * Write the Markdown template for the mailable.
     *
     * @return void
     */
    protected function createRequiredDirectories($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }
    }

    /**
     * Get the desired  name of the module from the input.
     *
     * @return string
     */
    protected function getIdentifierInput()
    {
        return trim($this->argument('identifier'));
    }
}
