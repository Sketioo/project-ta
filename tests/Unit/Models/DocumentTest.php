<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_document_can_be_created()
    {
        $document = Document::create([
            'title' => 'Panduan Akademik',
            'file_path' => 'documents/panduan_akademik.pdf',
            'is_visible' => true,
        ]);

        $this->assertDatabaseHas('documents', [
            'title' => 'Panduan Akademik',
            'file_path' => 'documents/panduan_akademik.pdf',
        ]);
        $this->assertInstanceOf(Document::class, $document);
    }

    /** @test */
    public function a_document_visibility_can_be_toggled()
    {
        $document = Document::factory()->create(['is_visible' => true]);

        $document->update(['is_visible' => false]);

        $this->assertFalse($document->is_visible);
        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'is_visible' => false,
        ]);
    }
}
