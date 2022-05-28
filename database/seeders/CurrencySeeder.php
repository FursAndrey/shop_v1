<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'code' => 'BYN',
                'rate' => 1,
            ],
            [
                'code' => 'USD',
                'rate' => 2.5,
            ],
            [
                'code' => 'EUR',
                'rate' => 2.7,
            ],
        ]);
    }
}
