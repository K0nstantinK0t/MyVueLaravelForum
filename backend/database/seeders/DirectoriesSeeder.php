<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make a root directory
        DB::table('directories')->insert([
            'parent_id' => null,
            'name' => 'root'
        ]);
    }
}
