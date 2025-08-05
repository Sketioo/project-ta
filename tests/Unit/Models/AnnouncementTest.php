<?php

namespace Tests\Unit\Models;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_announcement_can_be_created()
    {
        $announcement = Announcement::factory()->create([
            'title' => 'Pengumuman Penting',
            'content' => 'Ini adalah isi pengumuman penting.',
            'category' => 'akademik',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('announcements', [
            'title' => 'Pengumuman Penting',
            'category' => 'akademik',
            'is_published' => true,
        ]);
        $this->assertInstanceOf(Announcement::class, $announcement);
    }

    /** @test */
    public function an_announcement_can_be_updated()
    {
        $announcement = Announcement::factory()->create();

        $announcement->update([
            'title' => 'Judul Diubah',
            'is_published' => false,
        ]);

        $this->assertDatabaseHas('announcements', [
            'id' => $announcement->id,
            'title' => 'Judul Diubah',
            'is_published' => false,
        ]);
    }

    /** @test */
    public function an_announcement_can_be_deleted()
    {
        $announcement = Announcement::factory()->create();

        $announcement->delete();

        $this->assertDatabaseMissing('announcements', [
            'id' => $announcement->id,
        ]);
    }

    /** @test */
    public function photos_path_is_casted_to_array()
    {
        $announcement = Announcement::factory()->create([
            'photos_path' => ['path/to/photo1.jpg', 'path/to/photo2.jpg'],
        ]);

        $this->assertIsArray($announcement->photos_path);
        $this->assertEquals(['path/to/photo1.jpg', 'path/to/photo2.jpg'], $announcement->photos_path);
    }
}
