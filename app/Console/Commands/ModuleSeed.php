<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModuleSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:seed {moduleName}';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $module = $this->argument('moduleName');
        if(is_dir(base_path('app/Modules/'.$module.'/Database/Seeders'))) {
            \Artisan::call("db:seed" ,[
                '--class' => "\\App\\Modules\\{$module}\\Database\\Seeders\\{$module}Seeder",
            ]);
            $this->info("{$module}Seeder has been Seeded Successfully!!");
        }
        return 0;
    }
}
