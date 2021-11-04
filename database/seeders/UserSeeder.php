<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'permission' => 'Owner',
            'title' => 'Full Access',
            'index' => true,
            'create' => true,
            'store' => true,
            'show' => true,
            'edit' => true,
            'update' => true,
            'destroy' => true,
            'is_available' => true,  
            'record_by' => 1,
        ]);

        User::create([
            'business_id' => 1,
            'customer_id' => 0,
            'api_token' => "-",
            'image' => 'default.png',
            'name' => 'Zuhair Mustafa',
            'email' => 'dashboard@sabzify.pk',
            'password' => Hash::make('12345678'),
            'email_verified_at' => '2021-01-01 00:00:00',
            'phone' => '923347229439',
            'is_verified' => true,
            'address' => "Karachi, Pakistan",
            'role_id' => $role->id,
            'is_available' => true,
            'record_by' => 1,
        ]);
    }
}
