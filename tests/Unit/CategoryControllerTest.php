<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
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
        $response = $this->get("api/items/categories");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name'
            ]
        ]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
