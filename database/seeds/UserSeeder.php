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
                'name' => 'user' . $i,
                'email' => 'test' . $i . '@test.test',
                'password' => bcrypt('test1234'),
                'created_at' => $faker->date('Y-m-d H:i'),
                'updated_at' => $faker->date('Y-m-d H:i'),
            ]);
        }
        $this->call(ArticleSeeder::class);
    }
}
