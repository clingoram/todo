<?php

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
     * Delete
     */
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
     * Insert
     */
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
     * Find
     */
    // public function test_specific_category()
    // {
    //     $find = Category::first();
    //     $response = $this->get("api/items/categories/{$find->id}");
    //     // $response->assertStatus(200);
    //     $this->assertEquals(200, $response->getStatusCode());
    // }

}
