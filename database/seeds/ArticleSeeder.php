<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fr_FR');
        foreach (range(1, 50) as $index) {
            DB::table('articles')->insert([
                'title' => $faker->words($faker->numberBetween(1, 4), $asText = true),
                'image' => $faker->numberBetween(1, 10) . '.jpg',
                'content' => $faker->text(700),
                'published' => $faker->boolean(),
                'nbViews' => $faker->numberBetween(0, 500),
                'category_id' => $faker->numberBetween(1, 6)
            ]);
        }
    }
}
