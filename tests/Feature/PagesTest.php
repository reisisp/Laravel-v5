<?php

namespace Tests\Feature;

use App\models\Categories;
use Tests\TestCase;


class PagesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Все новости');
        $response->assertDontSeeText('Категории');
    }

    public function testAllCategoriesPage()
    {
        $response = $this->get('/categories');

        $response->assertStatus(200);
        $response->assertSeeText('Категории');
        $response->assertDontSeeText('Все новости');
    }

    public function testEachCategory()
    {
        $categories = Categories::getCategoriesEnNames();
        foreach ($categories as $value) {
            $response = $this->get('/categories/' . $value);
            $response->assertStatus(200);
        }
    }
}
