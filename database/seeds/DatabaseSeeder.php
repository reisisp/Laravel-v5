<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FirstAdminSeeder::class);
        $this->call(ResourcesSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesSeeder::class);
        // $this->call(NewsSeeder::class);
    }
}
