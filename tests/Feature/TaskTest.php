<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{

    use RefreshDatabase; //每次執行時都要重整資料庫(空)
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $response = $this->get('/');
        // $response->assertStatus(200);

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
        $response = $this->post('/api/items/store', [
            'description' => '做運動',
            'status' => false,
            'created_at' => now(),
            'end_at' => '2021-10-30 21:00:16',
            'category' => 1
        ]);

        $response->assertStatus(201);
        $response->getStatusCode();
    }

    /**
     * 取得特定ID資料
     */
    // public function testSpecificTask()
    // {
    //     $response = $this->get("/api/item/1");
    //     $response->assertStatus(200);
    // }
}
