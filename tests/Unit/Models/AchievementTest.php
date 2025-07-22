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
            'nim' => '1234567890',
            'semester' => 'Ganjil',
            'class' => 'A',
            'title' => 'Juara Lomba Coding',
            'description' => 'Memenangkan lomba coding tingkat nasional.',
            'file_path' => null,
            'is_accepted' => false,
            'status' => 'pending',
            'show_on_main_page' => false,
            'photo_path' => null,
        ]);

        $this->assertDatabaseHas('achievements', [
            'title' => 'Juara Lomba Coding',
            'user_id' => $user->id,
            'nim' => '1234567890',
            'semester' => 'Ganjil',
            'class' => 'A',
            'is_accepted' => false,
            'status' => 'pending',
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
            'validated_by' => null,
            'validated_at' => null,
        ]);

        $achievement->update([
            'status' => 'validated',
            'validated_by' => $validator->id,
            'validated_at' => now(),
        ]);

        $this->assertEquals('validated', $achievement->status);
        $this->assertEquals($validator->id, $achievement->validated_by);
        $this->assertNotNull($achievement->validated_at);
        $this->assertDatabaseHas('achievements', [
            'id' => $achievement->id,
            'status' => 'validated',
            'validated_by' => $validator->id,
        ]);
    }

    /** @test */
    public function an_achievement_can_be_rejected()
    {
        $user = User::factory()->create();
        $validator = User::factory()->create();
        $achievement = Achievement::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'validated_by' => null,
            'validated_at' => null,
        ]);

        $achievement->update([
            'status' => 'rejected',
            'validated_by' => $validator->id,
            'validated_at' => now(),
        ]);

        $this->assertEquals('rejected', $achievement->status);
        $this->assertEquals($validator->id, $achievement->validated_by);
        $this->assertNotNull($achievement->validated_at);
        $this->assertDatabaseHas('achievements', [
            'id' => $achievement->id,
            'status' => 'rejected',
            'validated_by' => $validator->id,
        ]);
    }

    /** @test */
    public function an_achievement_can_be_shown_on_main_page()
    {
        $achievement = Achievement::factory()->create(['show_on_main_page' => false]);

        $achievement->update(['show_on_main_page' => true]);

        $this->assertTrue($achievement->show_on_main_page);
        $this->assertDatabaseHas('achievements', [
            'id' => $achievement->id,
            'show_on_main_page' => true,
        ]);
    }
}