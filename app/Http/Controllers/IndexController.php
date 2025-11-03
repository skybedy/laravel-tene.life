<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherDaily;
use App\Models\WeatherWeekly;
use App\Models\WeatherMonthly;

class IndexController extends Controller
{
    public function index()
    {
        $weatherData = $this->getWeatherData();

        return view('index',[
            'weatherData' => $weatherData,
            'weatherTimestamp' => $weatherData ? $this->getWeatherTimestamp() : null
        ]);
    }

    private function getWeatherData()
    {

        $filePath = public_path('files/weather.json');

        if (!file_exists($filePath)) {
            return null; // nebo []
        }

        $rawData = file_get_contents($filePath);

        $data = json_decode($rawData, true);

        return $data;
    }

    private function getWeatherTimestamp()
    {
        $filePath = public_path('files/weather.json');

        if (!file_exists($filePath)) {
            return null;
        }

        return filemtime($filePath);
    }



    public function webcamBig()
    {
        return view('webcam-big');
    }

    public function statistics()
    {
        // Get daily statistics (last 30 days)
        $dailyStats = WeatherDaily::orderBy('date', 'desc')
            ->limit(30)
            ->get();

        // Get weekly statistics (last 12 weeks)
        $weeklyStats = WeatherWeekly::orderBy('year', 'desc')
            ->orderBy('week', 'desc')
            ->limit(12)
            ->get();

        // Get monthly statistics (last 12 months)
        $monthlyStats = WeatherMonthly::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return view('statistics', [
            'dailyStats' => $dailyStats,
            'weeklyStats' => $weeklyStats,
            'monthlyStats' => $monthlyStats,
        ]);
    }
}
