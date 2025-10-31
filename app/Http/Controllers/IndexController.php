<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index',[
            'weatherData' => $this->getWeatherData()
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



    public function webcamBig()
    {
        return view('webcam-big');
    }




}
