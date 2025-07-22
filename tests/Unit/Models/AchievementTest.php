<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_achievement_can_be_created()
    {
        $user = User::factory()->create();
        $achievement = Achievement::create([
            'user_id' => $user->id,
            'title' => 'Juara Lomba Coding',
            'description' => 'Memenangkan lomba coding tingkat nasional.',
            'date' => '2023-01-15',
            'validator_id' => null,
            'status' => 'pending',
            'show_on_main_page' => false,
            'photo_path' => null,
        ]);

        $this->assertDatabaseHas('achievements', [
            'title' => 'Juara Lomba Coding',
            'user_id' => $user->id,
        ]);
        $this->assertInstanceOf(Achievement::class, $achievement);
    }

    /** @test */
    public function an_achievement_has_a_user()
    {
        $user = User::factory()->create();
        $achievement = Achievement::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $achievement->user);
        $this->assertEquals($user->id, $achievement->user->id);
    }

    /** @test */
    public function an_achievement_can_be_validated()
    {
        $user = User::factory()->create();
        $validator = User::factory()->create();
        $achievement = Achievement::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'validator_id' => null,
        ]);

        $achievement->update([
            'status' => 'validated',
            'validator_id' => $validator->id,
        ]);

        $this->assertEquals('validated', $achievement->status);
        $this->assertEquals($validator->id, $achievement->validator_id);
        $this->assertDatabaseHas('achievements', [
            'id' => $achievement->id,
            'status' => 'validated',
            'validator_id' => $validator->id,
        ]);
    }
}
