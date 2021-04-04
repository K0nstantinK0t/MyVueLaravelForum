<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DirectoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DirectoriesSeeder::class,
        ]);
    }
}
