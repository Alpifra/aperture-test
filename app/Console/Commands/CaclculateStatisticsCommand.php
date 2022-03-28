<?php

namespace App\Console\Commands;

use App\Models\Cache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CaclculateStatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate daily website geolocation and and log result';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $logs = DB::table('logs')
            ->select('params->geolocation->countryCode as countryCode')
            ->where('ended_at_date', '=', $today)
            ->get();
        
        $stats = $logs->countBy( function($log) {
            return $log->countryCode;
        });

        $stats->map( function ($number, $countryCode) use ($today) {
            Cache::firstOrCreate([
                'key'  => 'stats_' . $countryCode,
                'date' => $today
            ], [
                'value' => $number,
            ]);
        });

        $this->info('The command was successful and the results stats have been cached into DB!');
    }
}
