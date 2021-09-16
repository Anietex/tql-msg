<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $roles = collect([
            [
                'name'         => 'superadmin',
                'display_name' => 'Super Admin'
            ],
            [
                'name'         => 'admin',
                'display_name' => 'Admin'
            ],
            [
                'name'         => 'company',
                'display_name' => 'Company'
            ],
            [
                'name'         => 'employee',
                'display_name' => 'Employee'
            ]
        ]);


        $roles->map(function ($role){
            Role::updateOrCreate($role);
        });
    }
}
