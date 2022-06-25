<?php

namespace Database\Seeders;

use App\Models\reportHouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \app\Models\reportHouse::factory(20)->create();
        \app\Models\reportHotel::factory(20)->create();
        \app\Models\reportTouristic::factory(20)->create();
    }
}
