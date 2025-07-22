<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_agenda_can_be_created()
    {
        $agenda = Agenda::create([
            'title' => 'Rapat Tahunan',
            'description' => 'Rapat evaluasi kinerja tahunan.',
            'date' => '2023-07-25',
            'location' => 'Ruang Rapat Utama',
        ]);

        $this->assertDatabaseHas('agendas', [
            'title' => 'Rapat Tahunan',
            'location' => 'Ruang Rapat Utama',
        ]);
        $this->assertInstanceOf(Agenda::class, $agenda);
    }

    /** @test */
    public function an_agenda_can_be_updated()
    {
        $agenda = Agenda::factory()->create();

        $agenda->update([
            'title' => 'Rapat Bulanan',
            'location' => 'Online via Zoom',
        ]);

        $this->assertEquals('Rapat Bulanan', $agenda->title);
        $this->assertEquals('Online via Zoom', $agenda->location);
        $this->assertDatabaseHas('agendas', [
            'id' => $agenda->id,
            'title' => 'Rapat Bulanan',
            'location' => 'Online via Zoom',
        ]);
    }
}
