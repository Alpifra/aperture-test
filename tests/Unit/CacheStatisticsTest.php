<?php

namespace Tests\Unit;

use App\Models\Log;
use Tests\TestCase;
use App\Models\Cache;
use Illuminate\Support\Facades\DB;

class CacheStatisticsTest extends TestCase
{

    /** @test **/
    public function create_cache_with_model()
    {
        $this->assertNotEmpty(Cache::first());
        $today = date('Y-m-d');
        $logs = Log::select('params->geolocation->countryCode as countryCode')
            ->where('ended_at_date', '=', $today)
            ->get();

        $stats = $logs->countBy(function ($log) {
            return $log->countryCode;
        });

        $stats->map(function ($number, $countryCode) use ($today) {
            Cache::firstOrCreate([
                'key'  => 'stats_' . $countryCode,
                'date' => $today
            ], [
                'value' => $number,
            ]);
        });
    }

    /** @test
     * 
     * Found better performances than create_cache_with_model  
     **/
    public function create_cache_with_query_builder()
    {
        $this->assertNotEmpty(Cache::first());
        $today = date('Y-m-d');
        $logs = DB::table('logs')
            ->select('params->geolocation->countryCode as countryCode')
            ->where('ended_at_date', '=', $today)
            ->get();

        $stats = $logs->countBy(function ($log) {
            return $log->countryCode;
        });

        $stats->map(function ($number, $countryCode) use ($today) {
            Cache::firstOrCreate([
                'key'  => 'stats_' . $countryCode,
                'date' => $today
            ], [
                'value' => $number,
            ]);
        });
    }

    /** @test **/
    public function create_cache_with_array_loop()
    {
        $this->assertNotEmpty(Cache::first());
        $today = date('Y-m-d');
        $logs = DB::table('logs')
            ->select('params->geolocation->countryCode as countryCode')
            ->where('ended_at_date', '=', $today)
            ->get();

        $stats = $logs->countBy(function ($log) {
            return $log->countryCode;
        });

        foreach ($stats as $countryCode => $number) {
            Cache::firstOrCreate([
                'key'  => 'stats_' . $countryCode,
                'date' => $today
            ], [
                'value' => $number,
            ]);
        }
    }

    /** @test
     * 
     * Found equal performances than create_cache_with_array_loop  
     **/
    public function create_cache_with_collection_loop()
    {
        $this->assertNotEmpty(Cache::first());
        $today = date('Y-m-d');
        $logs = DB::table('logs')
            ->select('params->geolocation->countryCode as countryCode')
            ->where('ended_at_date', '=', $today)
            ->get();

        $stats = $logs->countBy(function ($log) {
            return $log->countryCode;
        });

        $stats->map(function ($number, $countryCode) use ($today) {
            Cache::firstOrCreate([
                'key'  => 'stats_' . $countryCode,
                'date' => $today
            ], [
                'value' => $number,
            ]);
        });
    }

}
