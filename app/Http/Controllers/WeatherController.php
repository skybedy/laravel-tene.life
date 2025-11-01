<?php

namespace App\Http\Controllers;

use App\Models\WeatherHourly;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WeatherController extends Controller
{
    /**
     * Display the weather charts page
     */
    public function charts()
    {
        return view('weather.charts');
    }

    /**
     * Get hourly weather data for charts (from midnight today)
     */
    public function getHourlyData(Request $request)
    {
        // Get data from midnight of current day
        $today = Carbon::today()->format('Y-m-d');

        $data = WeatherHourly::where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->orderBy('hour', 'asc')
            ->get();

        // Format data for Chart.js
        $labels = [];
        $temperatures = [];
        $pressures = [];
        $humidities = [];

        foreach ($data as $record) {
            $dateTime = Carbon::parse($record->date)->format('d.m') . ' ' . sprintf('%02d:00', $record->hour);
            $labels[] = $dateTime;
            $temperatures[] = (float) $record->avg_temperature;
            $pressures[] = (float) $record->avg_pressure;
            $humidities[] = (float) $record->avg_humidity;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                'temperature' => $temperatures,
                'pressure' => $pressures,
                'humidity' => $humidities,
            ],
        ]);
    }

    /**
     * Get available date range for data
     */
    public function getDateRange()
    {
        $firstRecord = WeatherHourly::orderBy('date', 'asc')->first();
        $lastRecord = WeatherHourly::orderBy('date', 'desc')->first();

        return response()->json([
            'first_date' => $firstRecord ? $firstRecord->date->format('Y-m-d') : null,
            'last_date' => $lastRecord ? $lastRecord->date->format('Y-m-d') : null,
        ]);
    }
}
