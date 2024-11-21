<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @description Run UserSeeder and test if Admin and Regular users are present in the database after running the UserSeeder
     */
    public function testUserSeeder()
    {
        $this->artisan('db:seed', ['--class' => 'UserSeeder']);

        $expectedUsers = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin'
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'role' => 'user'
            ]
        ];

        /**
         * Check if the Admin and Regular users are created
         */
        foreach ($expectedUsers as $expectedUser) {
            $this->assertDatabaseHas('users', $expectedUser);
        }

        /**
         * Check admin password is not null and it is correct
         */
        $admin = User::where('name', 'Admin User')->first();
        $this->assertNotNull($admin);
        $this->assertTrue(Hash::check('Admin_Pa$$word', $admin->password));

        /**
         * Check user password is not null and it is correct
         */
        $regularUser = User::where('name', 'Regular User')->first();
        $this->assertNotNull($regularUser);
        $this->assertTrue(Hash::check('User_Pa$$word', $regularUser->password));


    }

}
