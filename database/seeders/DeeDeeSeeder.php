<?php

namespace Database\Seeders;

use App\Models\DeeDee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeeDeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeeDee::factory()->count(20)->create();
    }
}
