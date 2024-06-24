<?php

namespace Database\Factories\HumanResources\Settings;

use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'register_id'   => User::get()->random( 1 )->first()->id,
            'description'   => $this->faker->sentence($nbWords = 3),
            'status'        => $this->faker->boolean,
        ];
    }
}

