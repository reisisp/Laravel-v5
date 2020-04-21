<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Faker\Factory::create('ru_RU');

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'title' => $faker->realText(rand(10, 15)),
                'news_text' => $faker->realText(rand(100, 200)),
                'is_private' => (boolean)rand(0, 1),
                'category_id' => rand(1, 5)
            ];
        }
        return $data;
    }
}
