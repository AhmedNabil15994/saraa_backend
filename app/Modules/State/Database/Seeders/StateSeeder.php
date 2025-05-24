<?php
namespace App\Modules\State\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Entities\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($state,$city_id)
    {
        DB::beginTransaction();
        Model::unguard();
        State::create([
            'title_ar' => $state['ar'],
            'title_en' => $state['en'], 
            'status' => 1, 
            'city_id' => $city_id
        ]);
        DB::commit();
    }
}
