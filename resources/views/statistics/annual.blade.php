<x-app-layout>
    <div class="mx-auto w-full sm:w-3/4 p-3 sm:p-4 md:p-6 lg:p-8">

        @php
            $currentLocale = app()->getLocale();
        @endphp

        <!-- Annual Statistics Header -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6 mb-4 sm:mb-6 md:mb-8">
            <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-gray-800 mb-1 sm:mb-2">{{ __('messages.annual_statistics_title') }}</h1>
            <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base">{{ __('messages.annual_statistics_subtitle') }}</p>
        </div>

        <!-- Annual Temperature Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6 mb-4 sm:mb-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.annual_temperature_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="annualTemperatureChart"></canvas>
            </div>
        </div>

        <!-- Annual Pressure Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6 mb-4 sm:mb-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.annual_pressure_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="annualPressureChart"></canvas>
            </div>
        </div>

        <!-- Annual Humidity Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6 mb-4 sm:mb-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.annual_humidity_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="annualHumidityChart"></canvas>
            </div>
        </div>

        <!-- Annual Sea Temperature Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6 mb-4 sm:mb-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.annual_sea_temperature_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="annualSeaTemperatureChart"></canvas>
            </div>
        </div>

    </div>

    @vite(['resources/js/statistics-charts.js'])
</x-app-layout>
