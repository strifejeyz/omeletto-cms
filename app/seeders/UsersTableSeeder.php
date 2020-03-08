<?php namespace App\Seeders;

use App\Models\User;
use Faker\Factory;
use Kernel\Security\Hash;

/**
 * Class UsersTableSeeder
 *
 * @package App\Seeders
 */
class UsersTableSeeder
{
    /**
     * Seed the database table
     */
    public function __construct()
    {
        User::insert([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'username',
            'password' => Hash::encode('password'),
            'email' => 'knyteblayde@gmail.com',
            'phone_number' => "+(63)965-600-3275",
            'role'  => 'admin',
            'active' => 'yes',
            'created' => time(),
            'updated' => time(),
        ]);

        $faker = Factory::create();

        for($i = 0; $i < 5; $i++):
            User::insert([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'username' => $faker->userName,
                'password' => Hash::encode('password'),
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'role'  => 'standard',
                'active' => 'yes',
                'created' => time(),
                'updated' => time(),
            ]);
        endfor;

    }
}