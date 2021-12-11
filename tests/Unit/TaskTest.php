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
