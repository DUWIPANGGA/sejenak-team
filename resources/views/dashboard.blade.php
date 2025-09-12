@extends('layouts.app')

@section('content')
<div class="w-full min-h-screen flex flex-col md:flex-row gap-6 overflow-y-auto p-8 justify-center align-middle">
    <!-- Left Column -->

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
                    <!-- Kalender akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
        <div class="md:flex flex-row py-4 px-0 h-full hidden gap-4">
            <div class="flex flex-col flex-1 p-0 gap-4">
                <a href="#" class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3">
                    <h2 class="text-h2 text-white text-shadow-h1 font-exo2 text-center">22:33 PM</h2>
                </a>
                <a href="#" class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3">
                    <h2 class="text-h2 text-white text-shadow-h1 font-exo2 text-center">SEP</h2>
                </a>
            </div>
            <div class="flex-1 p-0">
                <button class="h-full w-full border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3">
                    <h2 class="text-h2 text-white text-shadow-h1 font-exo2 text-center">SEP</h2>
                </button>
            </div>
        </div>
    </div>

    <!-- Middle Column -->
    <div class="w-full md:w-1/3 flex flex-col gap-6 py-4">
        <div class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3"></div>
        <div class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3"></div>
        <div class="flex-1 border border-dark rounded-playful-lg bg-primary flex items-center justify-center p-3"></div>
    </div>

    <!-- Right Column -->
    <div class="w-full md:w-1/3 flex flex-col gap-6 p-4">
        <div class="flex-1 border border-dark rounded-playful-lg bg-orange flex items-center justify-center p-3"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data contoh aktivitas
        const riwayatJournal = [5, 12, 18, 22];
        const riwayatMeditasi = [3, 8, 15, 20, 27];

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
            document.getElementById('currentTime').textContent = timeStr;
        }

        // Update singkatan bulan
        function updateMonthShort(month) {
            document.getElementById('currentMonthShort').textContent = monthShortNames[month];
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
                if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    cell.classList.add('bg-primary');
                    dayDiv.classList.add('inline-block', 'w-full', 'rounded', 'relative', 'cursor-pointer', 'font-bold', 'hover:bg-gray-200');
                } else {
                    dayDiv.classList.add('inline-block', 'w-full', 'rounded', 'relative', 'cursor-pointer', 'hover:bg-gray-200');
                }

                dayDiv.textContent = day;

                if (riwayatJournal.includes(day)) {
                    const journalIndicator = document.createElement('span');
                    journalIndicator.classList.add('absolute', 'bottom-1', 'left-1', 'w-3', 'h-3', 'rounded-full', 'bg-orange-500');
                    dayDiv.appendChild(journalIndicator);
                }

                if (riwayatMeditasi.includes(day)) {
                    const meditationIndicator = document.createElement('span');
                    meditationIndicator.classList.add('absolute', 'bottom-1', 'right-1', 'w-3', 'h-3', 'rounded-full', 'bg-purple-600');
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
@endsection
