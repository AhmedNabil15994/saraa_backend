<?php

namespace App\Console\Commands;

use App\Entities\Reservation;
use Illuminate\Console\Command;

class CheckReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reservations';

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
        try {
            Reservation::where('status',2)->whereRaw('NOW() >= (created_at + INTERVAL 30 MINUTE )')->update(['status'=>0]);
        } catch (Exception $e) {
            
        }
    }
}
