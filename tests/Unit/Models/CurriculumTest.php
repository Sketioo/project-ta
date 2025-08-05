<?php

namespace Tests\Unit\Models;

use App\Models\Curriculum;
use App\Models\CurriculumImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurriculumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_curriculum_can_be_created()
    {
        $curriculum = Curriculum::factory()->create([
            'name' => 'Kurikulum 2025',
            'description' => 'Deskripsi Kurikulum 2025.',
            'is_visible' => true,
        ]);

        $this->assertDatabaseHas('curricula', [
            'name' => 'Kurikulum 2025',
            'is_visible' => true,
        ]);
        $this->assertInstanceOf(Curriculum::class, $curriculum);
    }

    /** @test */
    public function a_curriculum_can_be_updated()
    {
        $curriculum = Curriculum::factory()->create();

        $curriculum->update([
            'name' => 'Kurikulum Terbaru',
            'is_visible' => false,
        ]);

        $this->assertDatabaseHas('curricula', [
            'id' => $curriculum->id,
            'name' => 'Kurikulum Terbaru',
            'is_visible' => false,
        ]);
    }

    /** @test */
    public function a_curriculum_can_be_deleted()
    {
        $curriculum = Curriculum::factory()->create();

        $curriculum->delete();

        $this->assertDatabaseMissing('curricula', [
            'id' => $curriculum->id,
        ]);
    }

    /** @test */
    public function a_curriculum_has_many_images()
    {
        $curriculum = Curriculum::factory()->create();
        CurriculumImage::factory()->create(['curriculum_id' => $curriculum->id]);
        CurriculumImage::factory()->create(['curriculum_id' => $curriculum->id]);

        $this->assertInstanceOf(CurriculumImage::class, $curriculum->images->first());
        $this->assertCount(2, $curriculum->images);
    }
}
