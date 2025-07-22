<?php

namespace Tests\Unit\Suggestions;

use Tests\TestCase;
use App\Models\Suggestion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuggestionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_suggestion_can_be_created(){
        $suggestion = Suggestion::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test suggestion.',
            'is_read' => false,
        ]);

        $this->assertDatabaseHas('suggestions', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test suggestion.',
            'is_read' => false,
        ]);

        $this->assertInstanceOf(Suggestion::class, $suggestion);
        $this->assertEquals('John Doe', $suggestion->name);
    }

    /** @test */
    public function a_suggestion_can_be_marked_as_read(){
        $suggestion = Suggestion::factory()->create(['is_read' => false]);

        $suggestion->update(['is_read' => true]);

        $this->assertTrue($suggestion->is_read);
        $this->assertDatabaseHas('suggestions', [
            'id' => $suggestion->id,
            'is_read' => true,
        ]);
    }
}
