@extends('layouts.app')

@section('title', 'Meditasi')

@section('content')
<div id="main-meditation-page" class="w-full h-full flex flex-col lg:flex-row bg-background p-4 md:px-8 lg:px-12 font-main gap-">
    
    <div class="flex-1 p-0 md:p-4 flex flex-col items-center justify-start gap-6">

        <div class="w-full max-w-xl p-6 bg-white border-2 border-dark rounded-playful-sm shadow-border-offset transition-all duration-300 transform hover:scale-105">
            <h2 class="text-h6 text-dark font-bold mb-2">Terakhir Anda Bermeditasi</h2>
            <div class="flex items-center justify-between">
                <p id="last-activity-text" class="text-sm text-gray-600">Memuat data terakhir...</p>
                <i class="fas fa-history text-secondary"></i>
            </div>
        </div>

        <div class="w-full max-w-xl p-6 bg-white border-2 border-dark rounded-playful-sm shadow-border-offset-lg transition-all duration-300 transform hover:-translate-y-1">
            <h3 class="text-h5 text-dark font-bold mb-4">Putar Meditasi Harian</h3>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button id="play-pause-btn" class="w-12 h-12 rounded-full bg-primary text-dark flex items-center justify-center border-2 border-dark shadow-border-offset-accent transition-all duration-200 hover:scale-110 active:shadow-none active:translate-x-1 active:translate-y-1">
                        <i id="play-pause-icon" class="fas fa-play text-xl"></i>
                    </button>
                    <div>
                        <p class="font-bold text-dark">Ketenangan Pagi</p>
                        <p class="text-xs text-gray-500">Panduan: 10 menit</p>
                    </div>
                </div>
                <div class="text-sm font-semibold text-gray-600">
                    <span id="current-time">0:00</span> / <span id="duration-time">10:00</span>
                </div>
            </div>
            <input type="range" id="meditation-progress" value="0" max="600" class="w-full h-2 mt-4 rounded-full accent-primary appearance-none bg-gray-200">
            <audio id="meditation-audio" src="{{ asset('path/to/your/audio.mp3') }}" preload="metadata"></audio>
        </div>

        <div class="w-full p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-white border-2 border-dark rounded-playful-md shadow-border-offset-lg transition-all duration-300 transform hover:scale-105">
                <h4 class="text-h5 text-dark font-bold mb-2">Meditasi Tanpa Panduan</h4>
                <p class="text-gray-600 text-sm mb-4">Gunakan timer untuk bermeditasi sesuai durasi yang Anda inginkan.</p>
                <a href="#" class="w-full px-4 py-3 bg-white text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset-accent text-center hover:bg-gray-100 transition-all duration-200 block">
                    <i class="fas fa-stopwatch mr-2"></i> Atur Timer
                </a>
            </div>

            <div class="p-6 bg-white border-2 border-dark rounded-playful-md shadow-border-offset-lg transition-all duration-300 transform hover:scale-105">
                <h4 class="text-h5 text-dark font-bold mb-2">Pernapasan dalam</h4>
                <p class="text-gray-600 text-sm mb-4">Latihan pernapasan singkat untuk menenangkan pikiran.</p>
                <a href="#" class="w-full px-4 py-3 bg-white text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset-accent text-center hover:bg-gray-100 transition-all duration-200 block">
                    <i class="fas fa-wind mr-2"></i> Latihan
                </a>
            </div>
        </div>
        
    </div>

    <div class="hidden lg:flex flex-1 flex-col p-4 md:p-8 items-center justify-start gap-6">
        
        <div class="w-full max-w-lg p-6 bg-white border-2 border-dark rounded-playful-md shadow-border-offset-lg transition-all duration-300 transform hover:-translate-y-1">
            <h3 class="text-h4 text-dark font-bold mb-4 text-center">Ringkasan Meditasi Anda</h3>
            <div class="flex justify-around items-center space-x-4 text-center">
                <div class="flex-1">
                    <p class="text-h3 text-primary font-extrabold mb-1">25</p>
                    <p class="text-sm text-gray-600">Sesi Selesai</p>
                </div>
                <div class="flex-1">
                    <p class="text-h3 text-secondary font-extrabold mb-1">150</p>
                    <p class="text-sm text-gray-600">Total Menit</p>
                </div>
                <div class="flex-1">
                    <p class="text-h3 text-dark font-extrabold mb-1">7</p>
                    <p class="text-sm text-gray-600">Hari Beruntun</p>
                </div>
            </div>
            <div class="mt-8">
                <canvas id="meditation-chart" width="400" height="200"></canvas>
            </div>
        </div>

        
        
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Skrip untuk pemutar audio
        const audio = document.getElementById('meditation-audio');
        const playPauseBtn = document.getElementById('play-pause-btn');
        const playPauseIcon = document.getElementById('play-pause-icon');
        const progress = document.getElementById('meditation-progress');
        const currentTimeEl = document.getElementById('current-time');
        const durationTimeEl = document.getElementById('duration-time');

        // Toggle play/pause
        playPauseBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                playPauseIcon.classList.remove('fa-play');
                playPauseIcon.classList.add('fa-pause');
            } else {
                audio.pause();
                playPauseIcon.classList.remove('fa-pause');
                playPauseIcon.classList.add('fa-play');
            }
        });

        // Update progress bar
        audio.addEventListener('timeupdate', () => {
            progress.value = (audio.currentTime / audio.duration) * 100;
            const currentMinutes = Math.floor(audio.currentTime / 60);
            const currentSeconds = Math.floor(audio.currentTime % 60);
            currentTimeEl.textContent = `${currentMinutes}:${currentSeconds < 10 ? '0' : ''}${currentSeconds}`;
        });

        // Seek audio when progress bar is changed
        progress.addEventListener('input', () => {
            const seekTime = (progress.value / 100) * audio.duration;
            audio.currentTime = seekTime;
        });

        // Set duration
        audio.addEventListener('loadedmetadata', () => {
            const durationMinutes = Math.floor(audio.duration / 60);
            const durationSeconds = Math.floor(audio.duration % 60);
            durationTimeEl.textContent = `${durationMinutes}:${durationSeconds < 10 ? '0' : ''}${durationSeconds}`;
        });

        // Reset when audio ends
        audio.addEventListener('ended', () => {
            playPauseIcon.classList.remove('fa-pause');
            playPauseIcon.classList.add('fa-play');
            progress.value = 0;
            currentTimeEl.textContent = '0:00';
        });

        // Placeholder for last activity
        const lastActivityText = document.getElementById("last-activity-text");
        if (lastActivityText) {
            const lastActivityData = {
                type: 'Meditasi Berpanduan',
                detail: 'Ketenangan Pagi, 10 menit yang lalu'
            };
            lastActivityText.innerText = `Terakhir ${lastActivityData.type}: ${lastActivityData.detail}`;
        }

        // Chart.js for Meditation Summary
        const ctx = document.getElementById('meditation-chart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Sesi Meditasi Mingguan',
                        data: [5, 4, 6, 7, 5, 8, 9],
                        backgroundColor: '#8FD14F',
                        borderColor: '#080330',
                        borderWidth: 2,
                        borderRadius: 5,
                        barPercentage: 0.6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e7eb',
                            },
                            ticks: {
                                color: '#4b5563',
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                color: '#4b5563',
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#080330',
                            bodyColor: '#4b5563',
                            borderColor: '#080330',
                            borderWidth: 1
                        }
                    }
                }
            });
        }
    });
</script>
@endsection