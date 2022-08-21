<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        DB::table('missions')->insert([
            'user_id' => 1,
            'display_name' => 'Test mission',
            'mode' => 'coop',
            'summary' => 'this is a summary',
        ]);
    }
}
