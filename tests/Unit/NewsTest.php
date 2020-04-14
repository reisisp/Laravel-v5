<?php

namespace Tests\Unit;

use App\models\News;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    private $columns = [
        'id', 'title', 'news_text', 'is_private', 'created_at', 'updated_at', 'category_id', 'category_en', 'category_ru'
    ];

// Принцип я понял, раписывать эти тесты можно до бесконесности порывая каждую возможную ошибку
    public function testIndexNews()
    {
        $news = News::getAllNews();
        $this->assertIsObject($news);
        $this->assertNotEmpty($news);
        foreach ($news as $key => $value) {
            $this->assertIsInt($key);
            $this->assertTrue($key >= 0);
            $this->assertIsObject($value);
            $this->assertNotEmpty($value);
            foreach ($value as $column => $data) {
                $this->assertIsNotInt($column);
                $this->assertNotNull($column);
                $this->assertTrue(in_array($column, $this->columns));
                if ($column == 'id') {
                    $this->assertTrue($data > 0);
                }
                if ($column == 'private') {
                    $this->assertIsBool($data);
                }
                if ($column == 'category_id') {
                    $this->assertIsNumeric($data);
                    $this->assertTrue($data > 0);
                }
            }
        }
    }
}
