<?php

namespace Database\Factories\HumanResources;

use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $death = $this->faker->boolean;
        $birthday = $this->faker->boolean;
        $voter_registration = $this->faker->boolean;
        $user_id = $this->faker->boolean ? User::get()->random( 1 )->first()->id : null;
        $sponsor_id = null;
        if($this->faker->boolean){
            $voters = Voter::get();
            $sponsor_id = $voters->count() > 0 ? $voters->random( 1 )->first()->id : null;
        }

        return [
            'address_id'   => (Address::factory()->create())->id,
            'user_id'   => $user_id,
            'sponsor_id'    => $sponsor_id,
            'name'   => $this->faker->name,
            'surname'   => $this->faker->firstName,
            'birthday'   => $birthday ? $this->faker->date() : null,
            'years_approximate'   => !$birthday ? $this->faker->numberBetween($min = 0, $max = 100) : null,
            'image'   => null,
            'death'   => $death,
            'death_date'   => $death ? $this->faker->date() : null,

            'cpf'   => $this->faker->cpf(false),
            'email'   => $this->faker->email,
            'whatsapp'   => $this->faker->cellphoneNumber( false ),
            'other_phones'   => $this->faker->cellphoneNumber( false ) . ", " . $this->faker->cellphoneNumber( false ),

            'instagram'   => $this->faker->url,
            'voter_registration_zone'   => $voter_registration? $this->faker->sentence($nbWords = 3) : null,
            'voter_registration_session'   => $voter_registration? $this->faker->sentence($nbWords = 3) : null,
            'social_history'   => $this->faker->text(),
            'votes_estimate'   => $this->faker->numberBetween(0, 1000),
            'votes_degree_certainty'   => $this->faker->numberBetween(0, 10),
            'supporter'        => $this->faker->boolean,
            'electoral_campaigner'        => $this->faker->boolean,
        ];
    }
}
