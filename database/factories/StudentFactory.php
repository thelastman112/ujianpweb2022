<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name;
        $nim = $this->faker->unique()->numberBetween(200602001, 200602999);
        $address = $this->faker->address;
        $phone = $this->faker->phoneNumber;
        $email = $this->faker->unique()->email;
        $birth_date = $this->faker->dateTimeBetween('-30 years', '-18 years');

        $user = User::create([
            'name' => $name,
            'username' => $nim,
            'email' => $email,
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('student');

        return [
            'user_id' => $user->id,
            'name' => $name,
            'nim' => $nim,
            'address' => $address,
            'phone' => $phone,
            'birth_date' => $birth_date,
        ];
    }
}
