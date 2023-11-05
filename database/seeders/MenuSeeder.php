<?php

namespace Database\Seeders;

use app\Models\Category;
use app\Models\Menu;
use app\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $user = User::all();
        for ($i = 1; $i <= 20; $i++){
            Menu::create([
                'menu_name' => "Menu $i",
                'categories'=> "This is sample a sample discription $i",
                'description' => $categories->random()->id,
                'description' => $user->random()->id,
            ]);
        }
    }
}
