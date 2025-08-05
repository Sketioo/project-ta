<?php

namespace Tests\Unit\Models;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_document_category_can_be_created()
    {
        $category = DocumentCategory::factory()->create([
            'name' => 'Akademik',
        ]);

        $this->assertDatabaseHas('document_categories', [
            'name' => 'Akademik',
        ]);
        $this->assertInstanceOf(DocumentCategory::class, $category);
    }

    /** @test */
    public function a_document_category_can_be_updated()
    {
        $category = DocumentCategory::factory()->create();

        $category->update([
            'name' => 'Non-Akademik',
        ]);

        $this->assertDatabaseHas('document_categories', [
            'id' => $category->id,
            'name' => 'Non-Akademik',
        ]);
    }

    /** @test */
    public function a_document_category_can_be_deleted()
    {
        $category = DocumentCategory::factory()->create();

        $category->delete();

        $this->assertDatabaseMissing('document_categories', [
            'id' => $category->id,
        ]);
    }

    /** @test */
    public function a_document_category_has_many_documents()
    {
        $category = DocumentCategory::factory()->create();
        $document = Document::factory()->create(['document_category_id' => $category->id]);

        $this->assertInstanceOf(Document::class, $category->documents->first());
        $this->assertEquals($document->id, $category->documents->first()->id);
    }
}
