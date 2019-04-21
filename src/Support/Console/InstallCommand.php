<?php

namespace AvoRed\Framework\Support\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:install';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install AvoRed e commerce an Laravel Shopping Cart';
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('AvoRed Install Successfully!');
    }
}
