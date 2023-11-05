<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variants') -> insert([

            [
                'variant_name' => 'Rice', //1
            ],
            [
                'variant_name' => 'Main Dish', //2
            ],
            [
                'variant_name' => 'Second Main', //3
            ],
            [
                'variant_name' => 'Pancit', //4
            ],
            [
                'variant_name' => 'Veg. Dish', //5
            ],
            [
                'variant_name' => 'Sea Foods', //6
            ],
            [
                'variant_name' => 'Dessert', //7
            ],
            [
                'variant_name' => 'Beverage', //8
            ],

        ]);
    }
}
