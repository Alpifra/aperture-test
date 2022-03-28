<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];
    
    protected $casts = [
        'params'             => 'array',
        'params.toSearch'    => 'array',
        'params.geolocation' => 'array',
        'params.language'    => 'array',
        'params.mobile'      => 'array',
        'ended_at_date'      => 'datetime:Y/m/d',
    ];
}
