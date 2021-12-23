<?php

/**
 * Seeding 是 Laravel 快速插入假資料的工具，透過自訂的規則生成假資料
 * 
 * 定義DB欄位的內容放在factory陣列內
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 告訴工廠要生成幾筆假資料
        Task::factory()->count(6)->create();
    }
}
