<x-app-layout>
    <div class="mx-auto w-full sm:w-3/4 p-4 sm-p-8">

   @php
        $timestamp = filemtime('images/tenelife.jpg');
        $hour = date('H', $timestamp);
        $date = date('d. m. Y', $timestamp);
        $time = date("$hour:i", $timestamp);
   @endphp
    
    <div class=" bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm overflow-hidden  border border-gray-300 sm:p-6">

        <div class="relative">
            
            <img src="{{ asset('images/tenelife.jpg') }}" alt="Webkamera výhled" class="w-full rounded-t-2xl">

            <div class="absolute top-3 lg:top-5 left-3 lg:left-5  
                        px-3 sm-px-8 py-1 sm:py-4 
                        rounded-xl sm:rounded-2xl 
                        bg-black/40 
                        text-xs sm:text-2xl text-white font-bold 
                        flex flex-col gap-y-1 items-left justify-center 
                        backdrop-blur-sm shadow-lg">
                <p class="underline">{{ $date }}, {{ $time }} </p>
                <p>Teplota - {{ $weatherData['temperature'] }} °C</p>
                <p>Tlak - {{ round($weatherData['pressure'],1) }} hPa</p>
                <p>Vlhkost - {{ $weatherData['humidity'] }} %</p>
            </div>
            

          <!-- Lupa v pravém horním rohu -->
            <a href="{{ route('index.webcam.big') }}"
            class="absolute top-3 lg:top-5 right-3 lg:right-5 
                 bg-black/40 
                 hover:bg-white/50 
                 text-white 
                 hover:text-black
                p-2 
                rounded-full 
                backdrop-blur-sm shadow-lg
                transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </a>
        </div>

        <div class="p-6">
            <h2 class="text-sm sm:text-xl font-semibold mb-1">Webkamera – Tenerife, Los Cristianos</h2>
            <p class="text-gray-600 text-xs sm:text-lg">
                Umístění: Avenida Ámsterdam<br>
                Směr: severovýchod, výhled na Montaña el Mojón 250 m/nm a Roque de Ichasagua 1001, při dobré viditelnosti pak v pozadí i na Pico del Teide 3715, Pico Viejo 3135 a Alto de Guajara 2715.
            </p>
        </div>
    </div>
     </div>
</x-app-layout>




