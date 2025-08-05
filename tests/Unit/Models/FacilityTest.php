<?php

namespace Tests\Unit\Models;

use App\Models\Facility;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FacilityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_facility_can_be_created()
    {
        $facility = Facility::factory()->create([
            'name' => 'Laboratorium Komputer',
            'description' => 'Laboratorium untuk praktikum mahasiswa.',
            'person_in_charge' => 'Bapak Fulan',
        ]);

        $this->assertDatabaseHas('facilities', [
            'name' => 'Laboratorium Komputer',
            'person_in_charge' => 'Bapak Fulan',
        ]);
        $this->assertInstanceOf(Facility::class, $facility);
    }

    /** @test */
    public function a_facility_can_be_updated()
    {
        $facility = Facility::factory()->create();

        $facility->update([
            'name' => 'Lab Komputer Baru',
            'person_in_charge' => 'Ibu Fulanah',
        ]);

        $this->assertDatabaseHas('facilities', [
            'id' => $facility->id,
            'name' => 'Lab Komputer Baru',
            'person_in_charge' => 'Ibu Fulanah',
        ]);
    }

    /** @test */
    public function a_facility_can_be_deleted()
    {
        $facility = Facility::factory()->create();

        $facility->delete();

        $this->assertDatabaseMissing('facilities', [
            'id' => $facility->id,
        ]);
    }

    /** @test */
    public function photos_is_casted_to_array()
    {
        $facility = Facility::factory()->create([
            'photos' => ['path/to/photo1.jpg', 'path/to/photo2.jpg'],
        ]);

        $this->assertIsArray($facility->photos);
        $this->assertEquals(['path/to/photo1.jpg', 'path/to/photo2.jpg'], $facility->photos);
    }
}
