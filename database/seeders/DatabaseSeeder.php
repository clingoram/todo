<?php

/**
 * databaseseeder 呼叫 other seeder files
 * 其他seeder files再依據method run()裡面設定的DB欄位內容而呼叫factory去產生對應的假資料，產生的假資料再到test做測試
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

        // call seeder
        $this->call([
            CategoryTableSeeder::class,
            TaskTableSeeder::class
        ]);
    }
}
