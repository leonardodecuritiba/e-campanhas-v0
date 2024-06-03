<?php

namespace Database\Factories;

use App\Models\HumanResources\Settings\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone'         => $this->faker->areaCode() . $this->faker->phoneNumber( false ),
            'cellphone'     => $this->faker->areaCode() . $this->faker->phoneNumber( false, true ),
            'email_contact' => $this->faker->unique()->safeEmail(),
        ];
    }
}