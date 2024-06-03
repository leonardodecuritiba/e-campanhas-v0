<?php

namespace Database\Factories;

use App\Models\Commons\Expense;
use App\Models\Commons\Observation;
use App\Models\HumanResources\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Observation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::get()->random(2);
        $parent = Expense::get()->random(1)->first();
        return [
            'parent_id'         => $parent->id,
            'owner_id'          => $user[0]->id,
            'type'              => "expenses",
            'descriptions'      => $this->faker->text(200)
        ];
    }
}
