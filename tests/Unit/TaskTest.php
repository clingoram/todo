<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use App\Models\Task;

class TaskTest extends TestCase
{
    // use RefreshDatabase;

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
    public function test_task_index_structure()
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
}
