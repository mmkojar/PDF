<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text('8'),
            'mobile_no' => $this->faker->phoneNumber('10'),
            'location' => $this->faker->text('5'),
            'salary' => $this->faker->numberBetween($min = 8000, $max = 15000),
            'status' => 1
        ];
    }
}
