<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());
    }

    private function getData()
    {
       // $faker = Faker\Factory::create('ru_RU');

        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.ru',
                'password' => Hash::make('123'),
                'is_admin' => 1
            ]
        ];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => 'test',
                'email' => 'user' . $i . '@mail.ru',
                'password' => Hash::make('123'),
                'is_admin' => 0
            ];
        }
        return $data;
    }
}
