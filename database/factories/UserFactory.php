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

        $once = $abilities[array_rand($abilities)];

        $this->faker->addProvider(new \Faker\Provider\id_ID\PhoneNumber($this->faker));

        $mobile = preg_replace('~[^0-9]~', '', $this->faker->unique()->phoneNumber);

        return [
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $mobile,
            'password' => app('hash')->make('123456'),
            'ability' => [$once]
        ];
    }
}
