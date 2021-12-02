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
    public function test_add_task()
    {
        $data = Task::make();
        $response = $this->post('api/items', [
            'description' => $data['description'],
            'status' => $data['status'],
            'created_at' => $data['created_at'],
            'end_at' => $data['end_at'],
            'category' => $data['classification']
        ]);

        $this->assertDatabaseCount('task', 6);
    }

    /** 
     * @test 
     * */
    public function test_specific_task()
    {
        $data = Task::first();
        $response = $this->get("api/items/{$data['id']}");
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** 
     * @test 
     * */
    // public function test_update_task()
    // {
    //     $getOne = Task::first();
    //     $data = [
    //         'description' => $this->faker->word,
    //         'status' => $this->faker->boolean($chanceOfGettingTrue = 50),
    //         'created_at' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Taipei'),
    //         'end_at' => $this->faker->dateTime($max = '+5 days', $timezone = 'Asia/Taipei'),
    //         'classification' => isset(Category::all()->random()->id) ? Category::all()->random()->id : $this->faker->numberBetween($min = 1, $max = 5),
    //         'updated_at' => now()
    //     ];

    //     $response = $this->put("api/items/{$getOne['id']}", $data);
    //     $response->assertStatus(201);
    // }

    /** 
     * @test 
     * */
    public function test_delete_task()
    {
        $data = Task::first();
        if ($data) {
            $data->delete();
            $this->assertSoftDeleted($data);
        }
        $this->assertTrue(true);
    }
}
