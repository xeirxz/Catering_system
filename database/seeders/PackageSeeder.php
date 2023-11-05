<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        

        DB::table('packages')->insert([
            [
                'price_id' => 1,
                'menu' => 'Steamed Rice',
                'variant_id' => 1
            ],
            [
                'price_id' => '1',
                'menu' => 'Pork Afritada',
                'variant_id' => 2
            ],
            [
                'price_id' => '1',
                'menu' => 'Lumpiang ShangHai',
                'variant_id' => 2
            ],
            [
                'price_id' => '1',
                'menu' => 'Buttered Chicken',
                'variant_id' => 2
            ],
            [
               
                'price_id' => '1',
                'menu' => 'Sotanghon Guisado',
                'variant_id' => 2
            ],
            [
                'price_id' => '1',
                'menu' => 'Pancit Bihon',
                'variant_id' => 2
            ],
            [
               
                'price_id' => '1',
                'menu' => 'Pancit Canton',
                'variant_id' => 2
            ],
            [
                'price_id' => '1',
                'menu' => 'Chop Suey',
                'variant_id' => 5
            ],
            [
                'price_id' => '1',
                'menu' => 'Four Season Vegetables',
                'variant_id' => 5
            ],
            [
                'price_id' => '1',
                'menu' => 'Fruit Salad',
                'variant_id' => 7
            ],
            [
                'price_id' => '1',
                'menu' => 'Mango Sago',
                'variant_id' => 7
            ],
            [
                'price_id' => '1',
                'menu' => 'Buko Pandan',
                'variant_id' => 7
            ],
            [
                'price_id' => '1',
                'menu' => 'Kakanin',
                'variant_id' => 7
            ],
            [
                'price_id' => '1',
                'menu' => 'Soft Drinks',
                'variant_id' => 8
            ],
            [
                'price_id' => '1',
                'menu' => 'Iced Tea',
                'variant_id' => 8
            ],
            [
               
                'price_id' => '1',
                'menu' => 'Fruit Juice',
                'variant_id' => 8              
            ],





            [
                'price_id' => '2',
                'menu' => 'Steamed Rice',
                'variant_id' => 1
            ],
            [
                
                'price_id' => '2',
                'menu' => 'Garlic Rice',
                'variant_id' => 1

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Beef with Onions',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Sweat & Sour Pork',
                'variant_id' => 2
            ],
            [
                'price_id' => '2',
                'menu' => 'Beef Bolgogi',
                'variant_id' => 2
            ],
            [
                'price_id' => '2',
                'menu' => 'Buttered Chicken',
                'variant_id' => 2
            ],
            [
                'price_id' => '2',
                'menu' => 'Chicken Cordon Bleu',
                'variant_id' => 2
            ],
            [
                'price_id' => '2',
                'menu' => 'Chicken Lollipop',
                'variant_id' => 2
            ],
            [
                
                'price_id' => '2',
                'menu' => 'Fish Fillet W/ Sweet & Sour or White Sauce',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Sotanghon Guisado',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Bam-i',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Pancit Canton',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Four Seasons Vegetables',
                'variant_id' => 5

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Buttered vegetables',
                'variant_id' => 5

                
            ],
            [
                
                'price_id' => '2',
                'menu' => 'Fruit Salad',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Mango Sago',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Buko Pandan',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Kakanin',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'SoftDrinks',
                'variant_id' => 8

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Iced Tea',
                'variant_id' => 8

                

            ],
            [
                
                'price_id' => '2',
                'menu' => 'Fruit Juice',
                'variant_id' => 8

                

            ],




            [
                
                'price_id' => '3',
                'menu' => 'Steamed Rice',
                'variant_id' => 1

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Garlic Rice',
                'variant_id' => 1

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Beef with Broccoli',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Sweet & Sour MeatBalls',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Beef Bolgogi',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Buttered Chicken',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Chicken Cordon Bleu',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Chicken Lollipop',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Fish Fillet w/ Sweet & Sour or White Sauce',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Spicy Seafood Pasta',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Spaghetti with Meat Sauce',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Carbonara',
                'variant_id' => 3

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Four Seasons Vegetables',
                'variant_id' => 5

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Buttered Vegetables',
                'variant_id' => 5

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Banana Cake',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Leche Flan',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Fresh Fruits',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Kakanin',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'SoftDrinks',
                'variant_id' => 8

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Iced Tea',
                'variant_id' => 8

                

            ],
            [
                
                'price_id' => '3',
                'menu' => 'Fruit Juice',
                'variant_id' => 8

                

            ],




            [
                
                'price_id' => '4',
                'menu' => 'Steamed Rice',
                'variant_id' => 1

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Garlic Rice',
                'variant_id' => 1

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Binagoongan Rice',
                'variant_id' => 1

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Pork Afritada',
                'variant_id' => 1

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Menudo',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Pork Hamonada',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Chicken',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Pork Adobo',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Special Beef Kare-kare',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Beef Caldereta',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Chicken Inasal',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Chicken Barbeque',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Adobong Pusit',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Inihaw na Isda',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Fish Escabeche',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Pinakbet',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Bicol Express',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Ginataang Gulay',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Pork Sinigang',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Tinolang Manok',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Cream of Corn',
                'variant_id' => 2
                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Mushroom',
                'variant_id' => 2

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Maja Blanca',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Biko with Latik',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Buko Pandan',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Fresh Fruits',
                'variant_id' => 7

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'SoftDrinks',
                'variant_id' => 8

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Iced Tea',
                'variant_id' => 8

                

            ],
            [
                
                'price_id' => '4',
                'menu' => 'Fruit Juice',
                'variant_id' => 8

                

            ],
           

        ]);
    }
}
