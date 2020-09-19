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
        for($i = 1; $i <= 50; $i++) {
            DB::table('articles')->insert([
                'title' => $faker->words($faker->numberBetween(1, 4), $asText = true),
                'image' => $faker->numberBetween(1, 10) . '.jpg',
                'content' => $faker->text(700),
                'published' => $faker->boolean(),
                'nbViews' => $faker->numberBetween(0, 500),
                'category_id' => $faker->numberBetween(1, 6),
                'created_at' => $faker->date('Y-m-d H:i'),
                'updated_at' => $faker->date('Y-m-d H:i'),
            ]);
            if($faker->boolean) {
                for($j = 1; $j < 5; $j++) {
                    DB::table('favorites_user_articles')->insert([
                        'user_id' => $j,
                        'article_id' => $i
                    ]);
                }
            }
        }
        $this->call(CommentsSeeder::class);
    }
}
