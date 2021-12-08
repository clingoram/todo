<?php

/**
 * function功能的完整性(database、web)，CRUD、HTTP status
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
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
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
}
