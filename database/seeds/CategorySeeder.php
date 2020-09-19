<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fr_FR');
        $categories = ['Animaux', 'Nature', 'People', 'Sport', 'Technologie', 'Ville'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => $faker->date('Y-m-d H:i'),
                'updated_at' => $faker->date('Y-m-d H:i'),
            ]);
        }
        $this->call(UserSeeder::class);
    }
}
