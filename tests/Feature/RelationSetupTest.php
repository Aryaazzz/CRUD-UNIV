<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationSetupTest extends TestCase
{
    use RefreshDatabase;

    public function test_prodi_route_is_available(): void
    {
        $response = $this->get('/prodi');

        $response->assertOk();
    }
}
