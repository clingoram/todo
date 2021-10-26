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
        //清除表格所有資料，並將流水號計數器歸零
        Task::truncate();

        // create 10 datas each time
        Task::factory()->count(10)->create();
    }
}
