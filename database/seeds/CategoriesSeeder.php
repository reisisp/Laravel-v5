<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $categories = [
        'science' => 'наука',
        'IT' => 'IT',
        'sports' => 'спорт',
        'health' => 'здоровье',
        'history' => 'история'
    ];

    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData()
    {
        $data = [];
        foreach ($this->categories as $key => $value) {
            $data[] = [
                'category_en' => $key,
                'category_ru' => $value
            ];
        }
        return $data;
    }
}
