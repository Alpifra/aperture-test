<?php

namespace App\Http\Controllers;

use App\Models\Cache;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $today = date('Y/m/d');
        $stats = Cache::where('key', 'like', 'stats_%')
            ->where('date', $request->input('date', $today))
            ->get();

        return view('stats.index', ['stats' => $stats]);
    }
}
