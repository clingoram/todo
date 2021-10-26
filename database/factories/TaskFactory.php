<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 依據table欄位，塞進對應的假資料
        return [
            'description' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'status' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Taipei'),
            'end_at' => $this->faker->dateTime($max = '+5 days', $timezone = 'Asia/Taipei'),
            'classification' => Category::all()->random()->id
        ];
    }
}
