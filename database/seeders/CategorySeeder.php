<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Technology']);
        Category::create(['name' => 'Travel']);
        Category::create(['name' => 'Food']);
        Category::create(['name' => 'Health and Fitness']);
        Category::create(['name' => 'Lifestyle']);
        Category::create(['name' => 'Sports']);
        Category::create(['name' => 'Entertainment']);
        Category::create(['name' => 'News and Current Affairs']);
    }
}
