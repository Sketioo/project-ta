<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartnerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_partner_can_be_created()
    {
        $partner = Partner::create([
            'name' => 'Mitra A',
            'logo_path' => 'logos/mitra_a.png',
            'website_url' => 'https://mitra-a.com',
            'is_visible' => true,
        ]);

        $this->assertDatabaseHas('partners', [
            'name' => 'Mitra A',
            'website_url' => 'https://mitra-a.com',
        ]);
        $this->assertInstanceOf(Partner::class, $partner);
    }

    /** @test */
    public function a_partner_visibility_can_be_toggled()
    {
        $partner = Partner::factory()->create(['is_visible' => true]);

        $partner->update(['is_visible' => false]);

        $this->assertFalse($partner->is_visible);
        $this->assertDatabaseHas('partners', [
            'id' => $partner->id,
            'is_visible' => false,
        ]);
    }
}
