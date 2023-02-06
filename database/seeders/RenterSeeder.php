<?php

namespace Database\Seeders;

use App\Models\Renter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Renter::factory()->count(5)->create();
        Renter::factory(1)->realDomain()->create();
        Renter::factory(1)->localhost()->create();
    }
}
