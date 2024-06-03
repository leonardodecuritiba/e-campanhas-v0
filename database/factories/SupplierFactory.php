<?php

namespace Database\Factories;

use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Contact;
use App\Models\HumanResources\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->boolean();
        $cpf = NULL;
        $cnpj = NULL;
        $exemption_ie = true;
        if($type){
            $cnpj = $this->faker->randomNumber( $nbDigits = 2 ) . $this->faker->randomNumber( $nbDigits = 3 ) .
                $this->faker->randomNumber( $nbDigits = 3 ) . "0001" . $this->faker->randomNumber( $nbDigits = 2 );
            $exemption_ie = $this->faker->boolean();
        } else {
            $cpf = $this->faker->randomNumber( $nbDigits = 3 ) . $this->faker->randomNumber( $nbDigits = 3 ) . $this->faker->randomNumber( $nbDigits = 3 ) .  $this->faker->randomNumber( $nbDigits = 2 );
        }

        $set = $this->faker->boolean;
        return [
            'address_id'   => function () {
                return Address::factory()->create()->id;
            },
            'contact_id'   => function () {
                return Contact::factory()->create()->id;
            },

            'type'              => $type,
            'cpf'               => $cpf,
            'cnpj'              => $cnpj,

            'ie'                => ( $type && $exemption_ie) ? null : $this->faker->randomNumber( $nbDigits = 4 ) . $this->faker->randomNumber( $nbDigits = 9 ),
            'exemption_ie'      => $exemption_ie,
            'social_reason'     => $this->faker->company,

            'active'            => $this->faker->boolean(),
        ];
    }
}
