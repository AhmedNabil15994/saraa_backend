<?php

namespace App\Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use Modules\User\Entities\Group;

class DashboardSeeder extends Seeder
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
        $this->insertUser();
        $this->insertGroups();
        DB::commit();
    }

    private function insertUser()
    {
        return User::create([
            'name' => 'Ahmed',
            'mobile' => '201558651994',
            'email' => 'admin@tocaan.com',
            'password' => "111111",
            'role_id' => "1",
        ]);
    }

    private function insertGroups()
    {
        return Group::create([
            'name_ar' => 'المشرف العام',
            'name_en' => 'Super Admin',
            'status' => 1,
        ]);
    }
}
