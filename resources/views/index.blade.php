<x-app-layout>
    <div class="mx-auto w-full sm:w-3/4 p-3 sm:p-4 md:p-6 lg:p-8">

   @php
        $timestamp = filemtime('images/tenelife.jpg');
        $hour = date('H', $timestamp);
        $date = date('j. n. Y', $timestamp);
        $time = date("$hour:i", $timestamp);
   @endphp

    <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm overflow-hidden border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">

        <div class="relative">

            <img src="{{ asset('images/tenelife.jpg') }}" alt="Webkamera výhled" class="w-full rounded-t-lg sm:rounded-t-xl md:rounded-t-2xl">

            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 md:top-4 md:left-4 lg:top-5 lg:left-5
                        px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 lg:px-5 lg:py-3 xl:py-4
                        rounded-lg sm:rounded-xl md:rounded-2xl
                        bg-black/40
                        text-[0.65rem] sm:text-xs md:text-sm lg:text-base xl:text-lg 2xl:text-xl text-white font-bold
                        flex flex-col gap-y-0.5 sm:gap-y-1 items-left justify-center
                        backdrop-blur-sm shadow-lg">
                <p class="underline">{{ $date }}, {{ $time }} </p>
                @if($weatherData)
                    <p>Teplota - {{ round($weatherData['temperature'],1) }} °C</p>
                    <p>Tlak - {{ round($weatherData['pressure'],1) }} hPa</p>
                    <p>Vlhkost - {{ round($weatherData['humidity']) }} %</p>
                @else
                    <p>Počasí je momentálně nedostupné</p>
                @endif
            </div>
            

          <!-- Lupa v pravém horním rohu -->
            <a href="{{ route('index.webcam.big') }}"
            class="absolute top-2 right-2 sm:top-3 sm:right-3 md:top-4 md:right-4 lg:top-5 lg:right-5
                 bg-black/40
                 hover:bg-white/50
                 text-white
                 hover:text-black
                p-1.5 sm:p-2 md:p-2.5
                rounded-full
                backdrop-blur-sm shadow-lg
                transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </a>
        </div>

        <div class="py-3 sm:py-4 md:py-5 lg:py-6">
            <h1 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold mb-2 sm:mb-3 text-gray-800">Webkamera – Tenerife, Los Cristianos</h1>
            <div class="space-y-2 sm:space-y-2.5 md:space-y-3">
                <div>
                    <h2 class="text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">Umístění a směr pohledu</h2>
                    <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base leading-relaxed">
                        Avenida Ámsterdam, severovýchod – výhled na Montaña el Mojón 250 m/nm a Roque de Ichasagua 1001, dále, úplně vpravo za stromem, na Morros del Viento 406 a při jasné obloze pak v pozadí i na Pico del Teide 3715, Pico Viejo 3135 a Alto de Guajara 2715.
                    </p>
                </div>
                <div>
                    <h2 class="text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">O zdroji meteorologických dat</h2>
                    <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base leading-relaxed">
                        Data o aktulální teplotě, tlaku a vlhkosti jsou odebírána z vlastní meteostanice a teplotního čidla v celodenně zastíněném místě, bez dosahu přímého slunce, takže se jedná čistě o hodnoty ve stínu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Weather Charts Section -->
    <div class="mt-4 sm:mt-6 md:mt-8 space-y-3 sm:space-y-4">
        <div class="px-1 sm:px-2">
            <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-gray-800 mb-1 sm:mb-2">Meteorologická data</h1>
            <p class="text-gray-600 text-[0.65rem] sm:text-xs md:text-sm lg:text-base">Grafy zobrazují hodinové průměry od půlnoci dnešního dne</p>
        </div>

        <!-- Temperature Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">Teplota (°C)</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="temperatureChart"></canvas>
            </div>
        </div>

        <!-- Pressure Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">Atmosférický tlak (hPa)</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="pressureChart"></canvas>
            </div>
        </div>

        <!-- Humidity Chart -->
        <div class="bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm border border-gray-300 p-3 sm:p-4 md:p-5 lg:p-6">
            <h2 class="text-sm sm:text-base md:text-lg font-semibold mb-3 sm:mb-4 text-gray-700">Relativní vlhkost (%)</h2>
            <div class="relative h-40 sm:h-48 md:h-56 lg:h-64">
                <canvas id="humidityChart"></canvas>
            </div>
        </div>
    </div>

     </div>

    @vite(['resources/js/weather-charts.js'])
</x-app-layout>




