<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $abilities = User::OPTION_ROLES;

        $random = array_values(array_intersect_key( $abilities, array_flip( array_rand( $abilities, 2 ) ) ));

        $once = $abilities[array_rand($abilities)];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique()->phoneNumber,
            'password' => app('hash')->make('123456'),
            'ability' => [$once]
        ];
    }
}
