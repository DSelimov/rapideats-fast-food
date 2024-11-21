<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a new user.
     *
     * This test verifies that a user can be created successfully using the factory,
     * and checks if the user's data is correctly stored in the database.
     *
     * @return void
     */
    public function testCreateUser()
    {
        User::factory()->create([
            'name' => 'Factory Test User',
            'email' => 'factorytest@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Factory Test User',
            'email' => 'factorytest@example.com',
        ]);
    }

    /**
     * Test the update functionality for a user.
     *
     * This test ensures that an existing user's details can be updated successfully
     * and verifies the database contains the updated data while the old data is removed.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
        ]);

        $user->update([
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => 'Original Name',
            'email' => 'original@example.com',
        ]);
    }

    /**
     * Test the deletion of a user.
     *
     * This test checks that a user can be deleted successfully
     * and verifies the user's data is removed from the database.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
