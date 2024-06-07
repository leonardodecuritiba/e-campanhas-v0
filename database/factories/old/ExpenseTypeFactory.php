<?php

namespace Database\Factories\old;

use App\Models\Commons\ExpenseType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExpenseType::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'          => $this->faker->randomNumber(5),
            'description'   => $this->faker->text(50),
            'active'        => $this->faker->boolean,
        ];
    }
}
