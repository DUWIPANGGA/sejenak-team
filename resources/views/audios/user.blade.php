@extends('layouts.app')

@section('content')
<div id="meditationPage" class="w-full min-h-screen flex-col md:flex-row bg-background p-4 md:p-12 font-main">
    <div class="flex-1 p-4 md:p-8 flex flex-col items-center justify-center">
        <a href="{{ route('meditasi.main') }}" class="self-start text-dark text-xl mb-6 md:mb-8 md:hidden"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-h1 text-dark text-center text-shadow-h1 mb-8 md:mb-12">Sesi Meditasi</h1>

        <div class="w-full max-w-xl bg-white border-2 border-dark rounded-playful-md shadow-border-offset-lg p-6 mb-8">
            <h2 class="text-h4 text-dark font-bold mb-4">Timer Meditasi</h2>
            <div class="text-center">
                <div id="timer-display" class="text-h1 font-mono text-dark mb-4">00:00</div>
                <div class="flex justify-center gap-4">
                    <button id="start-timer" class="px-6 py-3 bg-secondary text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset-accent hover:bg-secondary/80 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-200">Mulai</button>
                    <button id="stop-timer" class="px-6 py-3 bg-orange text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset-accent hover:bg-orange/80 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-200">Selesai</button>
                    <button id="reset-timer" class="px-6 py-3 bg-gray-200 text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset-accent hover:bg-gray-300 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-200">Reset</button>
                </div>
            </div>
        </div>

        <div class="w-full max-w-xl bg-white border-2 border-dark rounded-playful-md shadow-border-offset-lg p-6">
            <h2 class="text-h4 text-dark font-bold mb-4">Suara White Noise</h2>
            <p class="text-gray-600 mb-4" id="current-sound">Tidak Ada Suara</p>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <button class="white-noise-btn" data-sound="rain" data-title="Hujan">
                    🌧️ Hujan
                </button>
                <button class="white-noise-btn" data-sound="ocean" data-title="Ombak Laut">
                    🌊 Ombak
                </button>
                <button class="white-noise-btn" data-sound="forest" data-title="Hutan">
                    🌲 Hutan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Timer Logic
    let timerInterval;
    let seconds = 0;
    const timerDisplay = document.getElementById('timer-display');
    const startBtn = document.getElementById('start-timer');
    const stopBtn = document.getElementById('stop-timer');
    const resetBtn = document.getElementById('reset-timer');

    startBtn.addEventListener('click', () => {
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            seconds++;
            const mins = String(Math.floor(seconds / 60)).padStart(2, '0');
            const secs = String(seconds % 60).padStart(2, '0');
            timerDisplay.innerText = `${mins}:${secs}`;
        }, 1000);
    });

    stopBtn.addEventListener('click', () => {
        clearInterval(timerInterval);
    });

    resetBtn.addEventListener('click', () => {
        clearInterval(timerInterval);
        seconds = 0;
        timerDisplay.innerText = "00:00";
    });

    // White Noise Sound Logic
    const whiteNoiseButtons = document.querySelectorAll('.white-noise-btn');
    const currentSoundText = document.getElementById("current-sound");
    let currentAudio = null;

    whiteNoiseButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const sound = btn.getAttribute("data-sound");
            const title = btn.getAttribute("data-title");

            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
            }

            currentAudio = new Audio(`/sounds/${sound}.mp3`);
            currentAudio.loop = true;
            currentAudio.play();

            currentSoundText.innerText = `Memutar: ${title}`;
        });
    });
</script>
@endsection

{{-- @include('partials.meditasi-styles') --}}