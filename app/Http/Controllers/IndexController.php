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
        $rawData = file_get_contents(public_path('files/weather.json'));
        $data = json_decode($rawData, true);
        return $data;
    }


    public function webcamBig()
    {
        return view('webcam-big');
    }




}
