<?php

namespace AvoRed\Framework\Modules\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Filesystem\Filesystem;
use AvoRed\Framework\Support\Facades\Module;
use Symfony\Component\Console\Input\InputArgument;

class ControllerMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:controller:make';

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
    protected $description = 'Create a new controller for module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

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
        $identifier = strtolower($this->getIdentifierInput());

        [$vendor, $name] = explode('-', $identifier);

        $controllerName = $this->getNameInput();

        $stubFiles = ['controller'];

        foreach ($stubFiles as $stubFile) {
            $methodName = 'get'.ucfirst($stubFile).'Path';

            $path = $this->$methodName($vendor, $name, $controllerName);
            $this->createRequiredDirectories($path);

            $buildMethodName = 'build'.ucfirst($stubFile).'File';
            $this->files->put($path, $this->$buildMethodName());
        }

        $this->info($this->type.' created successfully.');
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
     * Get Controller Path.
     * @param string $vendor
     * @param string $name
     * @param string $controllerName
     * @return string $controllerPath
     */
    protected function getControllerPath($vendor, $name, $controllerName)
    {
        return base_path('modules/'.$vendor.'/'.$name.'/src/Http/Controllers/'.$controllerName.'.php');
    }

    /**
     * Build the class with the given name.
     *
     * @return string
     */
    protected function buildControllerFile()
    {
        $stubFiles = $this->getStub('controller');

        $stub = $this->files->get($stubFiles);
        $this->replaceNamespace($stub);

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub($stubName)
    {
        return __DIR__."/stubs/{$stubName}.stub";
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub)
    {
        $rootNamespace = App::getNamespace();

        $module = Module::get($this->getIdentifierInput());

        $baseNamespace = $module['namespace'];

        $namespace = $baseNamespace."Http\Controllers";

        $stub = str_replace(
            ['DummyClass', 'DummyRootNamespace', 'DummyNamespace'],
            [$this->getNameInput(), $rootNamespace, $namespace],
            $stub
        );

        return $this;
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

    /**
     * Get the desired  name of the module from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['identifier', InputArgument::REQUIRED, 'The identifier for the module'],
            ['name', InputArgument::REQUIRED, 'The name of the Controller'],
        ];
    }
}
