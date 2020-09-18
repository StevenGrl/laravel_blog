<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fr_FR');
        for($i = 1; $i < 5; $i++) {
            DB::table('users')->insert([
                'name' => 'test' . $i,
                'email' => 'test' . $i . '@test.test',
                'password' => bcrypt('test1234'),
                'created_at' => $faker->date('Y-m-d H:i'),
                'updated_at' => $faker->date('Y-m-d H:i'),
            ]);
            for($j = 1; $j <= 10; $j++) {
                DB::table('favorites_user_articles')->insert([
                    'user_id' => $i,
                    'article_id' => $j
                ]);
            }
        }
    }
}
