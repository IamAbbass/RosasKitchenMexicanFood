<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'permission' => 'User',
            'title' => 'Limited Access',
            'index' => false,
            'create' => false,
            'store' => false,
            'show' => false,
            'edit' => false,
            'update' => false,
            'destroy' => false,
            'is_available' => false,  
            'record_by' => 1,
        ]);
    }
}
