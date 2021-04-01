<?php

namespace Database\Factories;

use App\Models\_Todo_task;
use Illuminate\Database\Eloquent\Factories\Factory;

class Todo_taskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = _Todo_task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text,
            'status' => $this->faker->randomElements($array = array(1, 2, 0), $count = 1)
        ];
    }
}
