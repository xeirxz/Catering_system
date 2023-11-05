<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prices')->insert([
            [
                'category_id' => '1',
                'price' => 275,
                'price_name' => 'Krafty Kitchen',
                'price_description' => 'Choose 1 for Every Line',
                // 'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'category_id' => '2',
                'price' => 350,
                'price_name' => 'Disher Food',
                'price_description' => 'Choose 1 for Every Line'
                
            ],
            [
                'category_id' => '2',
                'price' => 375,
                'price_name' => 'Spiker Food',
                'price_description' => 'Choose 1 for Every Line'
            ],
            [
                'category_id' => '2',
                'price' => 400,
                'price_name' => 'Nuke Package',
                'price_description' => 'Choose 1 for Every Line'
            ],
        ]);
    }
}
