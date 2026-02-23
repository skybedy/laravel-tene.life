<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weather';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'measured_at',
        'temperature',
        'pressure',
        'humidity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'measured_at' => 'datetime',
        'temperature' => 'float',
        'pressure' => 'float',
        'humidity' => 'float',
    ];

    /**
     * Scope to filter by date
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('measured_at', $date);
    }
}
