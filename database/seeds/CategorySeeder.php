<?php

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
        $categories = ['Animaux', 'Nature', 'People', 'Sport', 'Technologie', 'Ville'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category
            ]);
        }
        $this->call(ArticleSeeder::class);
    }
}
