<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;


class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'image' => 'default.png',
            'name' => 'Sabzify - Head Office',
            'phone' => '923347229439',
            'email' => 'info@sabzify.pk',
            'address' => 'Karachi, Pakistan',
            'ntn' => '0',
            'strn' => '0',
            'is_available' => true,
            'record_by' => 1,
        ]);
    }
}
