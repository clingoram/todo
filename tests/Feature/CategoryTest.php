<?php

/**
 * php artisan test
 */

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // 每次測試完後，清空DB
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Get all categories
     */
    public function testAllCategories()
    {
        $response = $this->get('api/items/categories');
        $response->assertStatus(200);
    }

    /**
     * Insert
     */
    public function testCategoryInsert()
    {
        $data = Category::make();
        $response = $this->post('api/items/categories', [
            'name' => $data['name'],
            'created_at' => $data['created_at']
        ]);

        $response->assertStatus(200);
    }
}
