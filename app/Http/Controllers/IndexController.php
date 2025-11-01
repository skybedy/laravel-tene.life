<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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




}
