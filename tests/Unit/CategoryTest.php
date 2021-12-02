<?php

/**
 * 檢查function傳入的參數類型，回傳結果類型、結構
 */

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
// use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
    }
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
     * @test
     */
    public function test_category_index_structure()
    {
        $response = $this->get('api/items/categories');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name'
            ]
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_basic_request()
    {
        $response = $this->get('api/items/categories');

        // HTTP Test
        $response->assertStatus(200);
        $response->dumpHeaders();
        $response->dump();
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
    // public function test_seeder_works()
    // {
    //     $this->seed();
    // }


}
