<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
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
        return [
            'full_name' => $this->faker->name,
            'email'     => $this->faker->unique()->safeEmail,
            'password'  => $this->faker->password,
            'role'      => RolesEnum::ADMIN_ROLE,
            'status'    => 'active'
        ];
    }
}
