<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddNewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testAddNewsForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://lar.local/admin/create')
                ->assertSee('Добавить новость')
                ->type('title', 'text')
                ->type('news_text', '');
        });
    }
}
