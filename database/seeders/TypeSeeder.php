<?php

namespace Database\Seeders;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create(["name"=>"Moderators"]);
        Type::create(["name"=>"Author"]);
        Type::create(["name"=>"Readers"]);
        Type::create(["name"=>"Subscribers"]);
        Type::create(["name"=>"Commenters"]);

    }
}
