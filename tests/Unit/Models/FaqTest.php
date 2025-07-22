<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaqTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_faq_can_be_created()
    {
        $faq = Faq::create([
            'question' => 'Bagaimana cara mendaftar?',
            'answer' => 'Anda bisa mendaftar melalui halaman pendaftaran.',
            'is_visible' => true,
        ]);

        $this->assertDatabaseHas('faqs', [
            'question' => 'Bagaimana cara mendaftar?',
            'is_visible' => true,
        ]);
        $this->assertInstanceOf(Faq::class, $faq);
    }

    /** @test */
    public function an_faq_visibility_can_be_toggled()
    {
        $faq = Faq::factory()->create(['is_visible' => true]);

        $faq->update(['is_visible' => false]);

        $this->assertFalse($faq->is_visible);
        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'is_visible' => false,
        ]);
    }
}
