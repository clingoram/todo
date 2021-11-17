<?php

/**
 * php artisan test
 */

namespace Tests\Feature;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('api/items/categories');

        $response->assertStatus(200);
    }

    // Database Testing
    // public function testModelsInstantiated()
    // {
    //     $data = Category::factory()->count(3)->make();
    // }

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

        $response->assertStatus(201);
    }
}
