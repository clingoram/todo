<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        for ($i = 1; $i <= 5; $i++) {
            // 透過 DB class 建立資料
            DB::table('category')->insert([
                'id' => rand(1, 100),
                'name' => Str::random(10), // 產生長度 10 的字串
                'created_at' => time()
            ]);
        }
    }
}
