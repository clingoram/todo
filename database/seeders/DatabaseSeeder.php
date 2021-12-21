<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $category = DB::table('category')->get();
        $task = DB::table('task')->get();
        if (count($category) !== 0 and count($task) !== 0) {
            // 因為category ID是FK，所以無法直接用truncate()清除表格所有資料
            Schema::disableForeignKeyConstraints();
            Category::truncate();
            Task::truncate();
            Schema::enableForeignKeyConstraints();
        }
        // call seeder
        $this->call([
            CategoryTableSeeder::class,
            TaskTableSeeder::class
        ]);
    }
}
