<?php

namespace Tests\Unit\Models;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_created()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'role' => 'mahasiswa',
        ]);

        $this->assertDatabaseHas('users', [
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'role' => 'mahasiswa',
        ]);
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $user = User::factory()->create();

        $user->update([
            'name' => 'Jane Doe',
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Doe',
            'role' => 'admin',
        ]);
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /** @test */
    public function password_is_hashed_when_set()
    {
        $user = User::factory()->create([
            'password' => 'password123',
        ]);

        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /** @test */
    public function a_user_has_many_achievements()
    {
        $user = User::factory()->create();
        Achievement::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Achievement::class, $user->achievements->first());
    }
}
