<x-app-layout>
    <div class="mx-auto bg-white/30 rounded-2xl shadow-lg backdrop-blur-sm overflow-hidden w-3/4 border border-gray-300 m-8">

        <div class="relative">
            <img src="{{ asset('images/tenelife.jpg') }}" alt="Webkamera výhled" class="w-full rounded-t-2xl">

          <!-- Lupa v pravém horním rohu -->
            <a href="{{ route('index.webcam.big') }}"
            class="absolute top-3 lg:top-5 right-3 lg:right-5 
                 bg-black/60  
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
            <h2 class="text-xl font-semibold mb-1">Webkamera – Tenerife, Los Cristianos</h2>
            <p class="text-gray-600 text-sm">
                Umístění: Avenida Ámsterdam<br>
                Směr: severovýchod, výhled na Montaña el Mojón 250mnm a Roque de Ichasagua 1001, při dobré viditelnosti pak v pozadí i na Pico del Teide 3715, Pico Viejo 3135 a Alto de Guajara 2715.
            </p>
        </div>
    </div>
</x-app-layout>




