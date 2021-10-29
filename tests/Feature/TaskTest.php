<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// model
use App\Models\Task;
use App\Models\Category;

class TaskTest extends TestCase
{

    // use RefreshDatabase; //每次執行測試時都要重整資料庫
    // use DatabaseMigrations;
    use WithFaker;

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
     * Task
     */
    public function testTaskStructure()
    {
        $response = $this->get('/api/items');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'created_at',
                'end',
                'status',
                'category',
            ]
        ]);
    }

    /** 
     * 新增
     */
    public function testAddTask()
    {
        $data = Task::make();
        $response = $this->post('/api/items', [
            'description' => $data['description'],
            'status' => $data['status'],
            'created_at' => $data['created_at'],
            'end_at' => $data['end_at'],
            'category' => $data['classification']
        ]);

        $response->assertStatus(201);
    }

    /**
     * 取得特定ID資料
     */
    public function testSpecificTask()
    {
        $data = Task::first();
        $response = $this->get("/api/items/{$data['id']}");
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * 更新
     */
    public function testUpdateTask()
    {
        $getOne = Task::first();
        $data = [
            'description' => $this->faker->word,
            'status' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Taipei'),
            'end_at' => $this->faker->dateTime($max = '+5 days', $timezone = 'Asia/Taipei'),
            // 'classification' => $this->faker->numberBetween($min = 1, $max = 5)
            'classification' => Category::all()->random()->id,
            'updated_at' => now()
        ];

        $response = $this->put("/api/items/{$getOne['id']}", $data);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * 刪除
     */
    public function testDeleteTask()
    {
        $data = Task::first();
        $response = $this->delete("api/items/{$data['id']}");
        $response->assertStatus(200);
    }
}
