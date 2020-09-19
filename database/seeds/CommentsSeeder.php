<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
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
            DB::table('comments')->insert([
                'title' => $faker->words($faker->numberBetween(1, 4), $asText = true),
                'message' => $faker->text(700),
                'article_id' => $faker->numberBetween(1, 50),
                'user_id' => $faker->numberBetween(1, 4),
                'created_at' => $faker->date('Y-m-d H:i'),
                'updated_at' => $faker->date('Y-m-d H:i'),
            ]);
        }
    }
}
