<?php

/**
 * Feature:檢查API，回傳資料的結構和HTTP狀態(Http status code、cookie、session、JSON structure)
 * function功能的完整性(database、web)，API、HTTP status
 */

namespace Tests\Feature;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_making_an_api_request()
    {
        $response = $this->postJson('api/items/categories', ['name' => '運動']);

        $response->assertSee('新增成功');
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

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
