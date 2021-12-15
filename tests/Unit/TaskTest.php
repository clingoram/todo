<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use App\Models\Task;

class TaskTest extends TestCase
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
    public function testAllTaskData()
    {
        $data = Task::all();
        $this->assertTrue(true);
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
        $response->assertJsonStructure([
            'message',
            'status'
        ]);
    }
}
