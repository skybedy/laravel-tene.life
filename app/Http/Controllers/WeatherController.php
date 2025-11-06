<?php

namespace App\Http\Controllers;

use App\Models\WeatherHourly;
use App\Models\WeatherDaily;
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
        // Get date parameter or use today
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));

        $data = WeatherHourly::where('date', $date)
            ->orderBy('hour', 'asc')
            ->get();

        // Format data for Chart.js
        $labels = [];
        $temperatures = [];
        $pressures = [];
        $humidities = [];

        foreach ($data as $record) {
            $labels[] = sprintf('%02d:00', $record->hour);
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

    /**
     * Get daily statistics data for charts
     */
    public function getDailyData(Request $request)
    {
        $days = $request->input('days', 7); // Default 7 days
        $endDate = $request->input('end_date', Carbon::today()->format('Y-m-d'));

        $startDate = Carbon::parse($endDate)->subDays($days - 1);

        $data = WeatherDaily::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        $labels = [];
        $avgTemp = [];
        $minTemp = [];
        $maxTemp = [];
        $avgPressure = [];
        $avgHumidity = [];
        $seaTemp = [];

        foreach ($data as $record) {
            $labels[] = $record->date->format('j.n.');
            $avgTemp[] = (float) $record->avg_temperature;
            $minTemp[] = (float) $record->min_temperature;
            $maxTemp[] = (float) $record->max_temperature;
            $avgPressure[] = (float) $record->avg_pressure;
            $avgHumidity[] = (float) $record->avg_humidity;
            $seaTemp[] = $record->sea_temperature ? (float) $record->sea_temperature : null;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                'avg_temperature' => $avgTemp,
                'min_temperature' => $minTemp,
                'max_temperature' => $maxTemp,
                'avg_pressure' => $avgPressure,
                'avg_humidity' => $avgHumidity,
                'sea_temperature' => $seaTemp,
            ],
            'statistics' => [
                'temperature' => [
                    'avg' => count($avgTemp) > 0 ? round(array_sum($avgTemp) / count($avgTemp), 1) : 0,
                    'min' => count($minTemp) > 0 ? round(min($minTemp), 1) : 0,
                    'max' => count($maxTemp) > 0 ? round(max($maxTemp), 1) : 0,
                ],
                'pressure' => [
                    'avg' => count($avgPressure) > 0 ? round(array_sum($avgPressure) / count($avgPressure), 1) : 0,
                ],
                'humidity' => [
                    'avg' => count($avgHumidity) > 0 ? round(array_sum($avgHumidity) / count($avgHumidity)) : 0,
                ],
                'sea_temperature' => [
                    'avg' => count(array_filter($seaTemp)) > 0 ? round(array_sum(array_filter($seaTemp)) / count(array_filter($seaTemp)), 1) : null,
                ],
            ],
        ]);
    }

    /**
     * Store or update sea temperature for a specific date
     */
    public function storeSeaTemperature(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'temperature' => 'required|numeric|min:-10|max:50',
        ]);

        $date = $validated['date'];
        $temperature = round($validated['temperature'], 1);

        // Find or create the daily record
        $daily = WeatherDaily::firstOrNew(['date' => $date]);
        $daily->sea_temperature = $temperature;
        $daily->save();

        return response()->json([
            'success' => true,
            'message' => 'Sea temperature saved successfully',
            'data' => [
                'date' => $date,
                'sea_temperature' => $temperature,
            ],
        ]);
    }

    /**
     * Get sea temperature for a specific date
     */
    public function getSeaTemperature(Request $request)
    {
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));

        $daily = WeatherDaily::where('date', $date)->first();

        return response()->json([
            'date' => $date,
            'sea_temperature' => $daily ? $daily->sea_temperature : null,
        ]);
    }
}
