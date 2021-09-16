<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return false
     */
    public function run()
    {

        $adminRole = Role::where('name', 'superadmin')->first();
        if(!$adminRole)
            return false;
        $admin = [
            'first_name' => 'Admin',
            'last_name'  => 'Admin',
            'email'      => 'superadmin@admin.com',
            'password'   => bcrypt('password'),
            'role_id'    => $adminRole->id
        ];
        User::updateOrCreate($admin);
    }
}
