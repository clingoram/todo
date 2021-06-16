<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/api/item');

        $response->assertStatus(200);
    }

    /** 
     * For add new task
     * 
     * 
     * */
    public function add_task()
    {
        $response = $this->get('/api/item/store');
    }
}
