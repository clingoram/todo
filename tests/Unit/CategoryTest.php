<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
// use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Check duplicate
     */
    public function test_category_duplication()
    {
        $data = Category::make([
            'name' => '購物',
            'created_at' => '2021-11-12 09:13:26'
        ]);

        $data2 = Category::make([
            'name' => '工作',
            'created_at' => '2021-11-11 09:13:26'
        ]);

        $this->assertTrue($data->name != $data2->name);
    }

    // Seeder test
    public function test_seeder_works()
    {
        $this->seed();
    }
}
