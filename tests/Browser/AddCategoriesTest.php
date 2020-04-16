<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddCategoriesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testAddCategoriesForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://lar.local/admin/categories/create')
                ->assertSee('Добавить категорию')
                ->type('category_ru', 'text');
        });
        $this->browse(function (Browser $browser) {
            $browser->visit('http://lar.local/admin/categories/create')
                ->press('Добавить категорию')
                ->assertPathIs('/admin/categories/create')
                ->assertSee('Поле Название категории обязательно для заполнения.');
        });
    }

}
