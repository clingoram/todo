<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// model
use App\Models\Task;
use App\Models\Category;

class TaskTest extends TestCase
{

    // use RefreshDatabase;
    use WithFaker;

    /** 
     * @test 
     * */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** 
     * @test 
     * */
    public function test_update_task()
    {
        // $getOne = Task::first();
        $data = [
            'id' => 1,
            'description' => $this->faker->word,
            'status' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Taipei'),
            'end_at' => $this->faker->dateTime($max = '+5 days', $timezone = 'Asia/Taipei'),
            'classification' => isset(Category::all()->random()->id) ? Category::all()->random()->id : $this->faker->numberBetween($min = 1, $max = 5),
            'updated_at' => now()
        ];

        $response = $this->put("api/items/1", $data);
        $response->assertSuccessful();
    }
    /** 
     * @test 
     * */
    public function test_task_json_structure()
    {
        $response = $this->get('api/items');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'start',
                'end',
                'status',
                'category',
            ]
        ]);
    }

    /** 
     * @test 
     * */
    public function test_add_task_json_structure()
    {
        $data = Task::make();
        $response = $this->post(
            "api/items",
            [
                'description' => $data['description'],
                'status' => $data['status'],
                'created_at' => $data['created_at'],
                'end_at' => $data['end_at'],
                'category' => $data['classification']
            ]
        );
        // $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'status'
        ]);
    }

    // public function test_delete_task_json_structure()
    // {
    //     $id = 1;
    //     $response = $this->deleteJson("api/items/", [
    //         'id' => $id
    //     ]);
    //     $response->assertNoContent($status = 204);
    // }
}
