<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin 1',
            'username' => 'admin1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User 1',
            'username' => 'user1',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole('user');

        $student = User::create([
            'name' => 'Student 1',
            'username' => 'student1',
            'email' => 'student@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $student->assignRole('student');

        $lecturer = User::create([
            'name' => 'Lecturer 1',
            'username' => 'lecturer1',
            'email' => 'lecturer@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $lecturer->assignRole('lecturer');
    }
}
