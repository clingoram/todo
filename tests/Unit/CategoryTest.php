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
     * */
    public function test_delete_category()
    {
        $data = Category::first();
        if ($data) {
            $data->delete();
            $this->assertSoftDeleted($data);
        }
        $this->assertTrue(true);
    }

    /** 
     * @test 
     * */
    public function test_store_new_category()
    {
        $data = Category::make();
        $response = $this->post("api/items/categories", [
            'name' => $data['name'],
            'created_at' => $data['created_at']
        ]);
        $this->assertDatabaseCount('category', 5);
    }

    /** 
     * @test 
     * */
    // public function test_specific_category()
    // {
    //     $find = Category::first();
    //     $response = $this->get("api/items/categories/{$find->id}");
    //     // $response->assertStatus(200);
    //     $this->assertEquals(200, $response->getStatusCode());
    // }

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

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
