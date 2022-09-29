<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperadminAsignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->where('id',config('constant.SUPERADMIN_ID'))->first();
        $user->assignRole(config('constant.SUPERADMIN_ROLE_ID'));
    }
}
