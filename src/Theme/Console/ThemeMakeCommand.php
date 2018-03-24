<?php

namespace AvoRed\Framework\Theme\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class ThemeMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:theme:make';

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
    protected $description = 'Create a new Theme';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Theme';

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

        $stubFiles = ['register', 'layout', 'home'];

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
        return base_path('themes/'.$vendor.'/'.$name.'/'.'register.yaml');
    }

    protected function getLayoutPath($vendor, $name)
    {
        return base_path('themes/'.$vendor.'/'.$name.'/views/layouts/'.'app.blade.php');
    }

    protected function getHomePath($vendor, $name)
    {
        return base_path('themes/'.$vendor.'/'.$name.'/views/home/'.'index.blade.php');
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
        $this->replaceStubFileData($stub);

        return $stub;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildLayoutFile()
    {
        $stubFiles = $this->getStub('layout');

        $stub = $this->files->get($stubFiles);

        $this->replaceStubFileData($stub);

        return $stub;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildHomeFile()
    {
        $stubFiles = $this->getStub('home');
        $stub = $this->files->get($stubFiles);
        $this->replaceStubFileData($stub);

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
    protected function replaceStubFileData(&$stub)
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
