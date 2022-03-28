<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatisticsControllerTest extends TestCase
{

    /** @test **/
    public function stats_can_be_displayed_from_cache()
    {
        $response = $this->get(route('stats.index'));

        $response->assertStatus(200);
    }
    

}
