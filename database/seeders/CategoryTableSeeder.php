<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Schema;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 因為ID是FK，所以無法直接用truncate()清除表格所有資料
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Task::truncate();
        Schema::enableForeignKeyConstraints();

        // create 5 datas each time
        Category::factory()->count(5)->create();
    }
}
