<?php

namespace Database\Factories\old;

use App\Models\Commons\CepCities;
use App\Models\Commons\CepStates;
use App\Models\HumanResources\Settings\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $state_id = CepStates::get()->random( 1 )->first()->id;
        $city     = CepCities::findOrFailByStateId( $state_id )->random( 1 )->first();
        return [
            'state_id'   => $state_id,
            'city_id'    => $city->id,
            'city_code'  => $this->faker->randomNumber( $nbDigits = 8 ),
            'zip'        => $this->faker->randomNumber( $nbDigits = 8 ),
            'district'   => $this->faker->streetName,
            'street'     => $this->faker->streetName,
            'number'     => $this->faker->randomNumber( $nbDigits = 4 ),
            'complement' => $this->faker->word,
            'region'     => $this->faker->randomNumber( $nbDigits = 1 )
        ];
    }
}

