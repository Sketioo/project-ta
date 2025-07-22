<?php

namespace Tests\Unit\Commands;

use Tests\TestCase;
use App\Models\Suggestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class DeleteOldSuggestionsCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_old_read_suggestions(){
        // Create a suggestion that should be deleted (read and old)
        Suggestion::factory()->create([
            'is_read' => true,
            'created_at' => now()->subMonths(2),
        ]);

        // Create a suggestion that should NOT be deleted (read but not old)
        Suggestion::factory()->create([
            'is_read' => true,
            'created_at' => now()->subWeeks(2),
        ]);

        // Create a suggestion that should NOT be deleted (old but not read)
        Suggestion::factory()->create([
            'is_read' => false,
            'created_at' => now()->subMonths(2),
        ]);

        // Run the artisan command
        Artisan::call('app:delete-old-suggestions');

        // Assert that only the old, read suggestion was deleted
        $this->assertDatabaseCount('suggestions', 2);
        $this->assertDatabaseMissing('suggestions', [
            'is_read' => true,
            'created_at' => now()->subMonths(2),
        ]);
    }
}