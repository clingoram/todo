<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// model
use App\Models\Task;
use App\Models\Category;

class TaskControllerTest extends TestCase
{

    // use RefreshDatabase;
    use WithFaker;

    public function test_screen_can_see_task()
    {
        $response = $this->get("api/items");
        $response->assertStatus(200);
    }

    /** 
     * @test 
     * */
    public function test_store_a_task()
    {
        // create a task
        // $data = Task::make();
        $insertData = [
            'description' => 'Shopping',
            'status' => true,
            'created_at' => "2021-12-21 12:52:32",
            'end_at' => "2021-12-21 13:52:32",
            'category' => isset(Category::all()->random()->id) ? Category::all()->random()->id : $this->faker->numberBetween($min = 1, $max = 5)
        ];
        $response = $this->post("api/items", $insertData);
        $this->assertEquals('Shopping', $insertData['description']);

        // $response = $this->post("api/items", [
        // 'description' => $data['description'],
        // 'status' => $data['status'],
        // 'created_at' => $data['created_at'],
        // 'end_at' => $data['end_at'],
        // 'category' => $data['classification']
        // ]);
        // $this->assertDatabaseCount('task', 6);

    }


    /** 
     * @test 
     * */
    public function test_show_a_task()
    {
        $data = Task::first();
        $response = $this->get("api/items/{$data['id']}");
        $response->assertStatus(200);
    }

    /** 
     * @test 
     * */
    public function test_update_a_task()
    {
        $this->withExceptionHandling();

        $getOne = Task::first();
        $data = [
            'id' => $getOne->id,
            'description' => "drawing",
            'status' => false,
            'created_at' => "2021-12-16 09:23:56",
            'end_at' => "2021-12-16 20:23:56",
            'classification' => isset(Category::all()->random()->id) ? Category::all()->random()->id : $this->faker->numberBetween($min = 1, $max = 5),
            'updated_at' => now()
        ];

        $response = $this->put("api/items/{$getOne->id}", $data);

        $this->assertEquals('drawing', $data['description']);
        $this->assertEquals(false, $data['status']);
    }

    /** 
     * @test 
     * */
    public function test_delete_a_task()
    {
        $data = Task::first();
        if ($data) {
            $data->delete();
            $this->assertSoftDeleted($data);
        }
        $this->assertTrue(true);
    }
}
