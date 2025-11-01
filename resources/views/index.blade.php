<x-app-layout>
    <div class="mx-auto w-full sm:w-3/4 p-3 sm:p-4 md:p-6 lg:p-8">

   @php
        $timestamp = filemtime('images/tenelife.jpg');
        $hour = date('H', $timestamp);
        $date = date('j. n. Y', $timestamp);
        $time = date("$hour:i", $timestamp);
        $currentLocale = app()->getLocale();
   @endphp

    <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm overflow-hidden border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">

        <div class="relative aspect-video">

            <img src="{{ asset('images/tenelife.jpg') }}" alt="Webkamera výhled" class="w-full h-full object-cover rounded-t-lg sm:rounded-t-xl md:rounded-t-2xl">

            <!-- Weather Info Box - Top Left -->
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 md:top-4 md:left-4 lg:top-5 lg:left-5
                        px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 lg:px-5 lg:py-3 xl:py-4
                        rounded-lg sm:rounded-xl md:rounded-2xl
                        bg-black/40
                        text-[0.65rem] sm:text-xs md:text-sm lg:text-base xl:text-lg 2xl:text-xl text-white font-bold
                        flex flex-col gap-y-0.5 sm:gap-y-1 items-left justify-center
                        backdrop-blur-sm shadow-lg">
                <p class="underline">{{ $date }}, {{ $time }} </p>
                @if($weatherData)
                    <p>{{ __('messages.temperature') }} - {{ round($weatherData['temperature'],1) }} °C</p>
                    <p>{{ __('messages.pressure') }} - {{ round($weatherData['pressure'],1) }} hPa</p>
                    <p>{{ __('messages.humidity') }} - {{ round($weatherData['humidity']) }} %</p>
                @else
                    <p>{{ __('messages.weather_unavailable') }}</p>
                @endif
            </div>

            <!-- Language Switcher - Top Right (left of magnifier) -->
            <div class="absolute top-2 sm:top-3 md:top-4 lg:top-5
                        right-14 sm:right-16 md:right-18 lg:right-20
                        bg-black/40 backdrop-blur-sm shadow-lg
                        rounded-lg sm:rounded-xl md:rounded-2xl
                        p-1 sm:p-1.5 md:p-2
                        flex gap-1 sm:gap-1.5 md:gap-2">
                <a href="{{ url($currentLocale === 'cs' ? '/' : '/cs') }}"
                   class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 flex items-center justify-center rounded {{ $currentLocale === 'cs' ? 'bg-white/90' : 'bg-white/20 hover:bg-white/40' }} transition"
                   title="Čeština">
                    <span class="text-sm sm:text-base md:text-lg lg:text-xl">🇨🇿</span>
                </a>
                <a href="{{ url('/en') }}"
                   class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 flex items-center justify-center rounded {{ $currentLocale === 'en' ? 'bg-white/90' : 'bg-white/20 hover:bg-white/40' }} transition"
                   title="English">
                    <span class="text-sm sm:text-base md:text-lg lg:text-xl">🇬🇧</span>
                </a>
                <a href="{{ url('/es') }}"
                   class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 flex items-center justify-center rounded {{ $currentLocale === 'es' ? 'bg-white/90' : 'bg-white/20 hover:bg-white/40' }} transition"
                   title="Español">
                    <span class="text-sm sm:text-base md:text-lg lg:text-xl">🇪🇸</span>
                </a>
                <a href="{{ url('/de') }}"
                   class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 flex items-center justify-center rounded {{ $currentLocale === 'de' ? 'bg-white/90' : 'bg-white/20 hover:bg-white/40' }} transition"
                   title="Deutsch">
                    <span class="text-sm sm:text-base md:text-lg lg:text-xl">🇩🇪</span>
                </a>
 

                <a href="{{ url('/hu') }}"
                   class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 flex items-center justify-center rounded {{ $currentLocale === 'hu' ? 'bg-white/90' : 'bg-white/20 hover:bg-white/40' }} transition"
                   title="Magyar">
                    <span class="text-sm sm:text-base md:text-lg lg:text-xl">🇭🇺</span>
                </a>
            </div>

            <!-- Lupa v pravém horním rohu -->
            <a href="{{ url(($currentLocale !== 'cs' ? '/' . $currentLocale : '') . '/webcam/big') }}"
               class="absolute top-2 right-2 sm:top-3 sm:right-3 md:top-4 md:right-4 lg:top-5 lg:right-5
                      bg-black/40
                      hover:bg-white/50
                      text-white
                      hover:text-black
                       p-2 sm:p-2.5 md:p-3 xl:p-3.5
                      rounded-full
                      backdrop-blur-sm shadow-lg
                      transition
                      flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </a>
        </div>

        <div class="py-3 sm:py-4 md:py-5 lg:py-6">
            <h1 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold mb-2 sm:mb-3 text-gray-800">{{ __('messages.webcam_title') }}</h1>
            <div class="space-y-2 sm:space-y-2.5 md:space-y-3">
                <div>
                    <h2 class="text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">{{ __('messages.location_heading') }}</h2>
                    <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base leading-relaxed">
                        {{ __('messages.location_description') }}
                    </p>
                </div>
                <div>
                    <h2 class="text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">{{ __('messages.weather_source_heading') }}</h2>
                    <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base leading-relaxed">
                        {{ __('messages.weather_source_description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Weather Charts Section -->
    <div class="mt-4 sm:mt-6 md:mt-8 space-y-3 sm:space-y-4">
        <div class="px-1 sm:px-2">
            <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-gray-800 mb-1 sm:mb-2">{{ __('messages.weather_data_title') }}</h1>
            <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base">{{ __('messages.weather_data_subtitle') }}</p>
        </div>

        <!-- Temperature Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.temperature_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="temperatureChart"></canvas>
            </div>
        </div>

        <!-- Pressure Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.pressure_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="pressureChart"></canvas>
            </div>
        </div>

        <!-- Humidity Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">{{ __('messages.humidity_chart') }}</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="humidityChart"></canvas>
            </div>
        </div>
    </div>

     </div>

    @vite(['resources/js/weather-charts.js'])
</x-app-layout>




