<?php

namespace Test\Unit;

use App\Services\PropertyApi;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyApiTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_property_api_returns_a_successful_response()
    {
        $apiResponse = PropertyApi::get();

        $this->assertEquals(200, $apiResponse->status());
    }
}
