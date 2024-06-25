<?php

namespace Database\Factories\HumanResources;

use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'password'          => '123', // password
            'status'            => $this->faker->boolean,
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $role = $this->faker->randomElement(['admin', 'coordinator', 'registrar']);
            $user->assignRole($role);

            Voter::flushEventListeners();
            Voter::getEventDispatcher();
            Voter::factory()->state([
                'user_id' => $user->id,
            ])->create();
        });
    }
}

