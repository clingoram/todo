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
     * A basic unit test example.
     *
     * @return void
     */
    public function testAllTaskData()
    {

        // 取得所有資料
        $data = Task::all();

        // 結果
        $this->assertTrue(true);
    }
}
