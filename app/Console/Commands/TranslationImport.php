<?php

namespace App\Console\Commands;

use App\Abstracts\ModuleManager as Manager;
use Illuminate\Console\Command;

class TranslationImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations-modules:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $baseModules = config('modules.modules');
        $modules = $baseModules;
        $modules[] = 'All';
        $moduleName = $this->choice('Select Module To Import Translation From ',$modules,'All');
        if($moduleName == 'All'){
            foreach ($baseModules as $value) {
                $base = app_path("Modules/{$value}/Resources/Lang");
                $counter = $this->manager->importTranslations(false,$base,false,$value);
                $this->info('Done importing '.$value.' , processed '.$counter.' items!');
            }
        }else{
            $base = app_path("Modules/{$moduleName}/Resources/Lang");
            $counter = $this->manager->importTranslations(false,$base,false,$moduleName);
            $this->info('Done importing '.$moduleName.' , processed '.$counter.' items!');
        }
        
    }
}
