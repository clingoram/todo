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
        $response->assertStatus(200);
        // 不管成功或失敗，request後，傳給前端的JSON格式
        $response->assertJsonStructure([
            'message',
            'status'
        ]);
    }

    // public function test_delete_task_json_structure()
    // {
    // }
}
