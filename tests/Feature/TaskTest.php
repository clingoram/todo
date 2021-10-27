<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// model
use App\Models\Task;

class TaskTest extends TestCase
{

    // use RefreshDatabase; //每次執行測試時都要重整資料庫
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
     * Task JSON結構
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
     * 新增資料
     * */
    public function testAddTask()
    {
        // 500 = server出現問題
        $data = Task::get();
        $response = $this->post('/api/items/store', [
            'description' => $data['description'],
            'status' => $data['status'],
            'created_at' => $data['created_at'],
            'end_at' => $data['ens_at'],
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
        $response = $this->get("/api/item/{$data->id}");
        $response->assertStatus(200);
    }

    /**
     * Update
     */
    // public function testUpdate(){

    // }
}
