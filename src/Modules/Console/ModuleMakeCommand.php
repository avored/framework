<?php

namespace AvoRed\Framework\Modules\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class ModuleMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:module:make';

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
    protected $description = 'Create a new module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Module';

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
        $vendor = strtolower($this->getVendorInput());
        $name = strtolower($this->getNameInput());

        $stubFiles = ['register', 'module'];

        foreach ($stubFiles as $stubFile) {
            $methodName = 'get'.ucfirst($stubFile).'Path';

            $path = $this->$methodName($vendor, $name);
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

    protected function getRegisterPath($vendor, $name)
    {
        return base_path('modules/'.$vendor.'/'.$name.'/register.yml');
    }

    protected function getModulePath($vendor, $name)
    {
        return base_path('modules/'.$vendor.'/'.$name.'/src/Module.php');
    }

    /**
     * Build the class with the given name.
     *
     * @return string
     */
    protected function buildRegisterFile()
    {
        $stubFiles = $this->getStub('register');

        $stub = $this->files->get($stubFiles);
        $this->replaceNamespace($stub);

        return $stub;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildModuleFile()
    {
        $stubFiles = $this->getStub('module');

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
        $stub = str_replace(
            ['DummyVendor', 'DummyName', 'DummyLowerVendor', 'DummyLowerName'],
            [$this->getVendorInput(), $this->getNameInput(), strtolower($this->getVendorInput()), strtolower($this->getNameInput())],
            $stub
        );

        return $this;
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
     * Get the desired vendor name from the input.
     *
     * @return string
     */
    protected function getVendorInput()
    {
        return trim($this->argument('vendor'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['vendor', InputArgument::REQUIRED, 'The name of the vendor or company name'],
            ['name', InputArgument::REQUIRED, 'The name of the module'],
        ];
    }
}
