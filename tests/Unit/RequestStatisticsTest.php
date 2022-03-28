<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Cache;
use App\Models\Log;
use Illuminate\Support\Facades\DB;

class RequestStatisticsTest extends TestCase
{
    /** @test
     * 
     * Found equals performances with request_statistics_with_query_builder  
     **/
    public function request_statistics_with_model()
    {
        $today = date('Y/m/d');
        $stats = Cache::where('key', 'like', 'stats_%')
            ->where('date', $today)
            ->get();

        $this->assertNotEmpty($stats);
    }

    /** @test **/
    public function request_statistics_with_query_builder()
    {
        $today = date('Y/m/d');
        $stats = DB::table('caches')
            ->where('key', 'like', 'stats_%')
            ->where('date', $today)
            ->get();

        $this->assertNotEmpty($stats);
    }    

}
