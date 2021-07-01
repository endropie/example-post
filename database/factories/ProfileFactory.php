<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'fullname' => $this->faker->name,
            'nickname' => $this->faker->lastName,
            'user_id' => User::whereDoesntHave('profile')->get()->random(1)->first()->id
        ];
    }
}
