@extends('layouts.app')

@section('title', '5 Cara Sederhana Mengelola Stres di Tempat Kerja')

@section('content')
<div class="w-full h-full grid grid-cols-1 md:grid-cols-3 gap-8 px-8 py-4">
    <main class="md:col-span-2 overflow-y-auto pr-4">
        <div class="w-full bg-white rounded-playful-lg border-2 border-dark shadow-border-offset p-6 md:p-8 flex flex-col gap-6">

            {{-- 1. HEADER ARTIKEL --}}
            <header>
                <p class="text-sm font-semibold text-primary mb-2">KESEHATAN MENTAL</p>
                <h1 class="text-h2 md:text-h1 font-bold text-dark font-lexend mb-4 leading-tight">
                    5 Cara Sederhana Mengelola Stres di Tempat Kerja
                </h1>
                
                {{-- Info Penulis dan Tanggal --}}
                <div class="flex items-center gap-3 text-sm text-gray-500 border-t-2 border-b-2 border-dark py-3">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-dark shadow-border-offset bg-blue-300 font-bold text-white">
                        TS
                    </div>
                    <div>
                        <span>Oleh <strong class="text-dark">Tim Sejenak</strong></span>
                        <span class="mx-1">•</span>
                        <span>08 Oktober 2025</span>
                    </div>
                </div>
            </header>

            {{-- 2. GAMBAR UTAMA (FEATURED IMAGE) --}}
            <figure>
                <img src="https://picsum.photos/seed/mentalhealth/1200/600" alt="Ilustrasi artikel tentang stres di tempat kerja" class="w-full h-auto object-cover rounded-playful-lg border-2 border-dark shadow-border-offset">
            </figure>

            {{-- 3. ISI KONTEN ARTIKEL --}}
            <article class="prose max-w-none text-gray-800 leading-relaxed">
                <p>Stres di tempat kerja adalah tantangan yang umum dihadapi banyak orang. Tekanan dari tenggat waktu, beban kerja yang berat, hingga dinamika dengan rekan kerja bisa memicu stres. Namun, ada banyak cara efektif untuk mengelolanya tanpa harus merasa kewalahan.</p>
                
                <p>Dari teknik pernapasan sederhana hingga manajemen waktu yang lebih baik, mari kita jelajahi lima strategi praktis yang bisa Anda terapkan setiap hari untuk menciptakan lingkungan kerja yang lebih tenang dan pikiran yang lebih damai.</p>

                <h3 class="font-bold text-dark text-xl mt-6 mb-3">1. Teknik Pernapasan "Box Breathing"</h3>
                <p>Ketika merasa cemas atau tertekan, napas kita cenderung menjadi pendek dan cepat. Teknik "Box Breathing" (pernapasan kotak) dapat membantu menenangkan sistem saraf Anda seketika. Caranya:</p>
                <ul>
                    <li>Tarik napas perlahan melalui hidung selama 4 detik.</li>
                    <li>Tahan napas selama 4 detik.</li>
                    <li>Hembuskan napas perlahan melalui mulut selama 4 detik.</li>
                    <li>Tahan kembali selama 4 detik sebelum mengulangi.</li>
                </ul>
                <p>Lakukan siklus ini beberapa kali hingga Anda merasa lebih tenang. Anda bisa melakukannya di meja kerja tanpa ada yang menyadarinya.</p>
                
                <h3 class="font-bold text-dark text-xl mt-6 mb-3">2. Ambil Jeda Singkat (Micro-breaks)</h3>
                <p>Bekerja non-stop selama berjam-jam justru akan menurunkan produktivitas dan meningkatkan stres. Cobalah untuk mengambil jeda singkat setiap 60-90 menit. Jeda ini tidak perlu lama, cukup 5-10 menit untuk:</p>
                <ul>
                    <li>Berjalan-jalan sebentar di sekitar kantor.</li>
                    <li>Melakukan peregangan ringan.</li>
                    <li>Melihat ke luar jendela untuk mengistirahatkan mata.</li>
                    <li>Membuat teh atau kopi.</li>
                </ul>

                <blockquote class="border-l-4 border-primary pl-4 italic text-gray-600 my-6">
                    "Hampir semua hal akan bekerja kembali jika Anda mencabut stekernya selama beberapa menit... termasuk Anda." - Anne Lamott
                </blockquote>

                <p>Jeda singkat ini membantu "mereset" otak Anda, sehingga Anda bisa kembali bekerja dengan fokus yang lebih baik dan pikiran yang lebih segar.</p>
            </article>

            {{-- 4. FOOTER ARTIKEL (TAGS & SHARE) --}}
            <footer class="border-t-2 border-dark pt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-dark">Tags:</span>
                    <a href="#" class="text-sm bg-gray-200 text-dark px-2 py-1 rounded-playful-sm hover:bg-primary hover:text-white transition-colors">#Stres</a>
                    <a href="#" class="text-sm bg-gray-200 text-dark px-2 py-1 rounded-playful-sm hover:bg-primary hover:text-white transition-colors">#Kerja</a>
                    <a href="#" class="text-sm bg-gray-200 text-dark px-2 py-1 rounded-playful-sm hover:bg-primary hover:text-white transition-colors">#Mental</a>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-bold text-dark">Bagikan:</span>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-primary hover:text-white transition-colors">X</a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-primary hover:text-white transition-colors">F</a>
                </div>
            </footer>

        </div>
    </main>
    
    {{-- KOLOM KANAN (LEBAR 1/3) - SIDEBAR --}}
    <aside class="md:col-span-1 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <h3 class="font-bold text-dark text-lg mb-4">Artikel Populer</h3>
            <ul class="space-y-4 text-dark">
                <li><a href="#" class="hover:text-primary transition-colors duration-200">- Mengatasi Overthinking dengan Teknik 'Stop'</a></li>
                <li><a href="#" class="hover:text-primary transition-colors duration-200">- Manfaat Journaling untuk Kesehatan Mental</a></li>
                <li><a href="#" class="hover:text-primary transition-colors duration-200">- 5 Tanda Anda Mengalami 'Burnout'</a></li>
            </ul>
        </div>
        
        <div class="bg-primary p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <h3 class="font-bold text-white text-lg mb-2">Tentang Sejenak</h3>
            <p class="text-sm text-gray-800">Sejenak adalah platform untuk membantumu menemukan ketenangan dan bertumbuh menjadi versi terbaik dirimu.</p>
        </div>
    </aside>

</div>
@endsection