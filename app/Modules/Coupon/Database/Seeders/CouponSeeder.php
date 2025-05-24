<?php
namespace App\Modules\Coupon\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Entities\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        Model::unguard();
        Coupon::create([

        ]);
        DB::commit();
    }
}
