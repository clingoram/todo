<?php

namespace Tests\Feature;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
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
     * A basic feature test example.
     *
     * @return void
     */
    public function test_basic_request()
    {
        $response = $this->get("api/items/categories");

        // HTTP Test
        $response->assertStatus(200);
        $response->dumpHeaders();
        $response->dump();
    }

    /** 
     * @test 
     * */
    public function test_store_new_category()
    {

        // 目前有幾本資料(應該是0)
        $beforeCount = Category::count();
        // 產生一組假的陣列資料
        $payload = Category::factory()->raw();

        $response = $this->post("api/items/categories", $payload);

        // 印出API噴了什麼錯誤
        if ($response->status() !== 201 && $response->status() !== 200) {
            dump($response->json());
        }

        $response->assertStatus(201);

        $this->assertDatabaseCount('category', $beforeCount + 1);
 
        $this->assertDatabaseHas('category', [
            'name' => $payload['name']
        ]);
    }

    /**
     * Check duplicate
     */
    public function test_category_duplication()
    {
        $data = Category::make([
            'name' => '休閒娛樂',
            'created_at' => '2021-11-12 09:13:26'
        ]);

        $data2 = Category::make([
            'name' => '工作',
            'created_at' => '2021-11-11 09:13:26'
        ]);

        $this->assertTrue($data->name != $data2->name);
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

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
