@extends('layouts.app')

@section('title', 'Dashboard')

@section('style')
<script src="//unpkg.com/alpinejs" defer></script>
<style>
.indicator {
  position: absolute;
  width: 12px;
  height: 12px;
  border-radius: 9999px; /* bulat penuh */
  z-index: 10;
}

.journal-indicator {
  bottom: 4px;
  left: 4px;
  background-color: orange;
}

.meditation-indicator {
  bottom: 4px;
  right: 4px;
  background-color: purple;
}

</style>
@endsection
@section('content')
<div class="w-full h-full flex flex-col md:flex-row gap-6 overflow-y-none px-8 justify-center align-middle">
    <div class="w-full md:w-1/2 lg:w-1/3 flex flex-col gap-2 py-4">
        <div class="flex flex-row px-0 py-4 gap-4">
            <div id="timeBox" class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3">
                <h2 class="text-h2 text-white text-shadow-h1 font-exo2 text-center" id="currentTime">22:33 PM</h2>
            </div>
            <div id="monthBox" class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3">
                <h2 class="text-h2 text-white text-shadow-h1 font-exo2 text-center" id="currentMonthShort">SEP</h2>
            </div>
        </div>
        <div class="bg-primary p-2 rounded-3xl border-2 border-black shadow-lg">
            <div class="bg-white p-4 rounded-3xl border-2 ">
                <div id="calendarBody" class="grid grid-cols-7 gap-2">
                    </div>
            </div>
        </div>
        <div class="md:flex flex-row py-4 px-0 h-full hidden gap-4 w-full">
            <div class="flex flex-col flex-1 p-0 gap-4 w-1/2">
                <a href="#" class=" border border-dark rounded-playful-lg bg-secondary flex align-middle items-center justify-center p-3 gap-3">
                    <img src="{{ asset('assets/component/emote/ai_icon.svg') }}" alt="">
                    <p class="text-lg font-bold">Chat dengan nemo</p>
                </a>
                <a href="#" class="flex-1 border border-dark rounded-playful-lg bg-secondary flex items-center justify-center p-3">
                    <img src="{{ asset('assets/component/emote/setting.svg') }}" alt="">
                </a>
            </div>

            <div class="w-1/2">
                <button id="mood-record" class="h-full w-full border border-dark rounded-playful-lg bg-secondary flex flex-col items-center justify-center p-1">
                    <img src="{{ asset('assets/component/emote/face.svg') }}" alt="">
                    <b>Bagaimana mood anda hari ini?</b>
                </button>

                <div id="mood-modal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white rounded-playful-lg p-6 w-11/12 max-w-md shadow-border-offset-lg border-2 border-dark">
                        <h2 class="text-xl font-bold mb-4 text-dark">🌈 Catat Mood Anda</h2>

                        <label for="mood" class="block font-medium text-dark">Mood</label>
                        <select id="mood-select" class="w-full border-2 border-dark rounded-playful-sm p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">-- Pilih mood --</option>
                            <option value="happy">😊 Senang</option>
                            <option value="sad">😢 Sedih</option>
                            <option value="anxious">😰 Cemas</option>
                            <option value="stressed">😫 Stres</option>
                            <option value="calm">😌 Tenang</option>
                            <option value="angry">😡 Marah</option>
                            <option value="tired">🥱 Lelah</option>
                            <option value="energetic">⚡ Bersemangat</option>
                            <option value="relaxed">🌿 Santai</option>
                        </select>

                        <label for="note" class="block font-medium text-dark">Catatan</label>
                        <textarea id="mood-note" class="w-full border-2 border-dark rounded-playful-sm p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Tambahkan catatan (opsional)" rows="3"></textarea>

                        <div class="flex justify-end gap-3">
                            <button id="cancel-mood" class="px-4 py-2 rounded-playful-sm bg-gray-300 text-dark border-2 border-dark shadow-border-offset-sm hover:bg-gray-400 transition-colors">❌ Batal</button>
                            <button id="save-mood" class="px-4 py-2 rounded-playful-sm bg-primary text-white border-2 border-dark shadow-border-offset-sm hover:bg-green-600 transition-colors">✅ Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full md:w-1/3 flex flex-col gap-6 py-4">
        <div class="flex-1 border-2 border-dark rounded-playful-lg bg-primary shadow-border-offset p-3 h-1/2 overflow-y-hidden">
            <h3 class="text-lg font-bold text-white mb-3">Riwayat Jurnal</h3>
            <div class="flex flex-row overflow-y-hidden h-3/4 rounded-playful-lg border-dark border-2 ">
                <div class="flex-1 space-y-3 overflow-y-scroll pr-2 p-1 m-0 scrollbar-none">
                    @foreach ($user->journals as $item)
                    <div data-id="{{ $item['id'] }}" class="p-3 bg-gray-100 border-2 border-dark rounded-playful-md flex justify-between items-start cursor-pointer shadow-border-offset hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all
                {{ $item['active'] ? 'history-item-active' : '' }}">

                        <div class="flex flex-col">
                            <p class="text-sm font-bold text-dark">{{ $item['title'] }}</p>
                            <p class="text-xs text-gray-600 truncate w-40">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item['content']), 50, '...') }}
                            </p>
                        </div>

                        <span class="text-xs ml-2 {{ $item['active'] ? 'text-white/80' : 'text-gray-500' }}">
                            {{ \Carbon\Carbon::parse($item['updated_at'])->translatedFormat('d M Y') }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="w-full max-w-2xl h-1/2">
            <div class="border-2 border-dark rounded-playful-lg  bg-secondary shadow-border-offset p-5 overflow-hidden relative h-full">
                <div class="absolute -top-2 -right-2 w-20 h-20 rounded-full bg-pink-400 opacity-20"></div>
                <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-indigo-400 opacity-20"></div>

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-dark flex items-center">
                        <span class="mr-2 text-2xl">😊</span> Grafik Mood Mingguan
                    </h3>
                    <div class="flex space-x-1">
                        <div class="w-3 h-3 rounded-full bg-indigo-400 bubble bubble-1"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400 bubble bubble-2"></div>
                        <div class="w-3 h-3 rounded-full bg-pink-400 bubble bubble-3"></div>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="moodChart"></canvas>
                </div>

                <div class="flex justify-center mt-4 space-x-6">
                    <div class="flex flex-col items-center">
                        <span class="mood-emoji text-2xl">😢</span>
                        <span class="text-xs font-bold">Sedih</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mood-emoji text-2xl">😐</span>
                        <span class="text-xs font-bold">Biasa</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mood-emoji text-2xl">😊</span>
                        <span class="text-xs font-bold">Senang</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mood-emoji text-2xl">😁</span>
                        <span class="text-xs font-bold">Bahagia</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mood-emoji text-2xl">🤩</span>
                        <span class="text-xs font-bold">Luar Biasa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @php
                    $colors = ['bg-red-400','bg-blue-400','bg-green-400','bg-yellow-400','bg-purple-400','bg-pink-400','bg-orange-400','bg-grey-400'];
                    $randomColor = $colors[array_rand($colors)];
                    @endphp
    <div class="w-full md:w-1/3 p-4 flex flex-col gap-6">

        {{-- ======================================================= --}}
        {{-- PENGECEKAN DITAMBAHKAN DI SINI UNTUK MENCEGAH ERROR --}}
        {{-- ======================================================= --}}
        @if($topPost)
            <a href="" class="border-2 border-dark rounded-playful-lg bg-primary shadow-border-offset p-4 flex flex-col gap-3 h-2/3">
                <div class="flex justify-between items-center">
                    @if($topPost->is_anonymous)
                    {{-- Skenario 1: Postingan anonim --}}
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-dark shadow-border-offset mr-3 font-bold text-white {{ $randomColor }}">
                        <img src="{{ asset('assets/component/emote/anonymous.svg') }}" alt="Anonymous" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset object-cover">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold font-lexend text-dark text-lg">Anonymous</h3>
                        <p class="text-sm text-black font-lexend">@anonymous • {{ $topPost->created_at->diffForHumans() }}</p>
                    </div>
                    @else
                    {{-- Skenario 2: Postingan pengguna (dengan atau tanpa avatar) --}}
                    @if($topPost->user->avatar)
                    <img src="{{ asset($topPost->user->avatar) }}" alt="{{ $topPost->user->name }}" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset mr-3 object-cover">
                    @else
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-dark shadow-border-offset mr-3 font-bold text-white {{ $randomColor }}">
                        {{ strtoupper(substr($topPost->user->name, 0, 1)) }}
                    </div>
                    @endif
                    <div class="flex-1">
                        <h3 class="font-bold font-lexend text-dark text-lg">{{ $topPost->user->name }}</h3>
                        <p class="text-sm text-gray-500 font-lexend">{{ strtolower($topPost->user->name) }} • {{ $topPost->created_at->diffForHumans() }}</p>
                    </div>
                    @endif
                    <span class="text-xs text-gray-500"></span>
                </div>
                <div class="w-full  rounded-playful-lg mb-4 border-2 border-dark overflow-hidden shadow-border-offset min-h-2/3 h-3/4">
                    @if($topPost->image)
                    <div class="w-full h-auto rounded-playful-lg mb-4 border-2 border-dark overflow-hidden shadow-border-offset">
                        <img src="{{ asset('storage/' . $topPost->image) }}" alt="Post Image" class="w-full h-full object-cover">
                    </div>
                    @endif </div>
                <div class="text-sm text-gray-700">
                    <p class="font-medium font-lexend text-dark mb-4">{{ $topPost->content }}</p>
                </div>
            </a>
        @else
            {{-- ======================================================= --}}
            {{-- BAGIAN ELSE UNTUK KONDISI TIDAK ADA POST --}}
            {{-- ======================================================= --}}
            <div class="border-2 border-dark rounded-playful-lg bg-gray-100 shadow-border-offset p-4 flex flex-col justify-center items-center h-2/3">
                 <p class="text-dark font-lexend text-center">Belum ada postingan untuk ditampilkan saat ini. 😢</p>
            </div>
        @endif


        <div class="flex-1 border-2 border-dark rounded-playful-lg bg-primary shadow-border-offset p-3 flex flex-col justify-center items-center text-center h-1/3">

            @if($quote)
                <p id="quote" class="text-sm italic font-bold text-gray-700">
                    "{{ $quote['quote'] }}"
                </p>
                <span class="mt-2 text-xs text-gray-600">- {{ $quote['author'] }}</span>
            @else
                <p id="quote" class="text-sm italic text-gray-700">
                    "Tidak ada kata-kata mutiara hari ini."
                </p>
            @endif
        </div>

    </div>

</div>

@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const moodRecordBtn = document.getElementById('mood-record');
        const moodModal = document.getElementById('mood-modal');
        const cancelMoodBtn = document.getElementById('cancel-mood');
        const saveMoodBtn = document.getElementById('save-mood');
        const moodSelect = document.getElementById('mood-select');
        const moodNote = document.getElementById('mood-note');

        // Buka modal saat tombol mood record diklik
        moodRecordBtn.addEventListener('click', function() {
            moodModal.classList.remove('hidden');
            moodModal.classList.add('flex');
        });

        // Tutup modal saat tombol batal diklik
        cancelMoodBtn.addEventListener('click', function() {
            moodModal.classList.remove('flex');
            moodModal.classList.add('hidden');
            resetMoodForm();
        });

        // Tutup modal saat klik di luar modal
        moodModal.addEventListener('click', function(e) {
            if (e.target === moodModal) {
                moodModal.classList.remove('flex');
                moodModal.classList.add('hidden');
                resetMoodForm();
            }
        });

        // Simpan mood saat tombol simpan diklik
        saveMoodBtn.addEventListener('click', async function() {
            const mood = moodSelect.value;
            const note = moodNote.value;

            if (!mood) {
                alert('Silakan pilih mood terlebih dahulu!');
                return;
            }

            try {
                const res = await fetch("{{ route('user.mood') }}", {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                        , "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        , "X-Requested-With": "XMLHttpRequest"
                    }
                    , body: JSON.stringify({
                        user_id: "{{ auth()->id() }}"
                        , mood: mood
                        , note: note
                    })
                });

                const data = await res.json();

                if (data.success) {
                    alert('Mood berhasil disimpan ✅');
                    moodModal.classList.remove('flex');
                    moodModal.classList.add('hidden');
                    resetMoodForm();
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal menyimpan mood ❌');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi error. Cek console untuk detail.');
            }
        });

        // Fungsi untuk mereset form mood
        function resetMoodForm() {
            moodSelect.value = '';
            moodNote.value = '';
        }
    });

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data contoh aktivitas dari Laravel
    const riwayatJournal = @json($riwayatJournal); // contoh: [18,18]
    const riwayatMeditasi = @json($riwayatMeditasi); // contoh: [18]

    const monthShortNames = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Fungsi update jam real-time
    function updateTime() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;

        const timeStr = `${hours}:${minutes} ${ampm}`;
        const timeBox = document.getElementById('currentTime');
        if (timeBox) {
            timeBox.textContent = timeStr;
        }
    }

    // Update singkatan bulan
    function updateMonthShort(month) {
        const monthBox = document.getElementById('currentMonthShort');
        if (monthBox) {
            monthBox.textContent = monthShortNames[month];
        }
    }

    // Fungsi render kalender bulan ini saja
    function renderCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Minggu mulai Senin
        let startingDay = firstDay === 0 ? 6 : firstDay - 1;

        const calendarBody = document.getElementById('calendarBody');
        calendarBody.innerHTML = '';

        // Sel kosong sebelum tanggal 1
        for (let i = 0; i < startingDay; i++) {
            const emptyCell = document.createElement('div');
            calendarBody.appendChild(emptyCell);
        }

        const today = new Date();

        for (let day = 1; day <= daysInMonth; day++) {
            const cell = document.createElement('div');
            cell.classList.add('text-center', 'p-2', 'relative', 'content-calendar');

            const dayDiv = document.createElement('div');
            dayDiv.classList.add(
                'inline-block', 'w-full', 'rounded', 'relative', 
                'cursor-pointer', 'hover:bg-gray-200'
            );

            if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                cell.classList.add('bg-primary');
                dayDiv.classList.add('font-bold');
            }

            dayDiv.textContent = day;

            // Tanda Journal (bulat oranye kiri bawah)
            if (riwayatJournal.includes(day)) {
                const journalIndicator = document.createElement('span');
                journalIndicator.classList.add(
                    'absolute', 'bottom-1', 'left-1',
                    'w-3', 'h-3', 'rounded-full',
                    'bg-orange-500', 'z-10'
                );
                dayDiv.appendChild(journalIndicator);
            }

            // Tanda Meditasi (bulat ungu kanan bawah)
            if (riwayatMeditasi.includes(day)) {
                const meditationIndicator = document.createElement('span');
                meditationIndicator.classList.add(
                    'absolute', 'bottom-1', 'right-1',
                    'w-3', 'h-3', 'rounded-full',
                    'bg-purple-600', 'z-10'
                );
                dayDiv.appendChild(meditationIndicator);
            }

            cell.appendChild(dayDiv);
            calendarBody.appendChild(cell);
        }
    }

    // Render kalender dan update bulan singkat & jam
    updateMonthShort(currentMonth);
    renderCalendar(currentMonth, currentYear);
    updateTime();
    setInterval(updateTime, 1000);
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('moodChart').getContext('2d');

          const moodLabels = @json($labels);
    const moodData = @json($data);
        const days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

        // Warna untuk setiap hari
        const backgroundColors = [
            'rgba(251, 146, 60, 0.6)'
            , 'rgba(249, 115, 22, 0.6)'
            , 'rgba(245, 158, 11, 0.6)'
            , 'rgba(251, 146, 60, 0.6)'
            , 'rgba(249, 115, 22, 0.6)'
            , 'rgba(245, 158, 11, 0.6)'
            , 'rgba(251, 146, 60, 0.6)'
        ];

        const borderColors = [
            'rgb(251, 146, 60)'
            , 'rgb(249, 115, 22)'
            , 'rgb(245, 158, 11)'
            , 'rgb(251, 146, 60)'
            , 'rgb(249, 115, 22)'
            , 'rgb(245, 158, 11)'
            , 'rgb(251, 146, 60)'
        ];

        new Chart(ctx, {
            type: 'bar'
            , data: {
                labels: days
                , datasets: [{
                    label: moodLabels
                    , data: moodData
                    , backgroundColor: backgroundColors
                    , borderColor: borderColors
                    , borderWidth: 2
                    , borderRadius: 10
                    , borderSkipped: false
                , }]
            }
            , options: {
                responsive: true
                , maintainAspectRatio: false
                , plugins: {
                    legend: {
                        display: false
                    }
                    , tooltip: {
                        backgroundColor: 'rgba(45, 55, 72, 0.9)'
                        , titleFont: {
                            family: 'Nunito'
                            , size: 14
                        }
                        , bodyFont: {
                            family: 'Nunito'
                            , size: 14
                        }
                        , padding: 12
                        , cornerRadius: 8
                        , callbacks: {
                            label: function(context) {
                                let label = 'Mood: ' + context.parsed.y + '/5 - ';
                                switch (context.parsed.y) {
                                    case 1:
                                        label += '😢 Sedih';
                                        break;
                                    case 2:
                                        label += '😐 Biasa';
                                        break;
                                    case 3:
                                        label += '😊 Senang';
                                        break;
                                    case 4:
                                        label += '😁 Bahagia';
                                        break;
                                    case 5:
                                        label += '🤩 Luar Biasa';
                                        break;
                                }
                                return label;
                            }
                        }
                    }
                }
                , scales: {
                    y: {
                        min: 0
                        , max: 5
                        , ticks: {
                            stepSize: 1
                            , font: {
                                family: 'Nunito'
                                , size: 12
                                , weight: 'bold'
                            }
                            , callback: function(value) {
                                switch (value) {
                                    case 1:
                                        return '😢';
                                    case 2:
                                        return '😐';
                                    case 3:
                                        return '😊';
                                    case 4:
                                        return '😁';
                                    case 5:
                                        return '🤩';
                                    default:
                                        return '';
                                }
                            }
                        }
                        , grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                            , lineWidth: 2
                        }
                    }
                    , x: {
                        grid: {
                            display: false
                        }
                        , ticks: {
                            font: {
                                family: 'Nunito'
                                , size: 12
                                , weight: 'bold'
                            }
                        }
                    }
                }
                , animation: {
                    duration: 1500
                    , easing: 'easeOutBounce'
                }
            }
        });
    });

</script>
@endsection