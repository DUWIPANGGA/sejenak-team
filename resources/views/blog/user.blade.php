@extends('layouts.app')

@section('title', 'Blog')

@section('content')

{{-- Layout utama menggunakan grid 3 kolom di desktop, konsisten dengan halaman lain --}}
<div class="w-full h-full grid grid-cols-1 md:grid-cols-3 gap-8 px-8 py-4">

    {{-- 
        KOLOM KIRI (LEBAR 2/3) - KONTEN UTAMA BLOG
        - `overflow-y-auto`: Mengaktifkan scroll vertikal HANYA untuk kolom ini.
        - `pr-4`: Memberi sedikit jarak antara konten dan scrollbar.
    --}}
    <main class="md:col-span-2 overflow-y-auto pr-4">
        {{-- Panel utama yang membungkus seluruh konten di kolom ini --}}
        <div class="w-full bg-white rounded-playful-lg border-2 border-dark shadow-border-offset p-6 flex flex-col gap-8">
            
            {{-- Bagian Header & Search --}}
            <div class="text-center">
                <h1 class="text-h2 md:text-h1 font-bold text-dark font-lexend">Sejenak Blog</h1>
                <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Temukan artikel, tips, dan wawasan seputar kesehatan mental, meditasi, dan pengembangan diri.</p>
                <div class="relative max-w-md mx-auto mt-6">
                    <input type="text" placeholder="Cari Artikel..." class="w-full border-2 border-dark rounded-playful-sm p-2 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button class="absolute top-1/2 right-3 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.76l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
            </div>

            {{-- Garis pemisah visual --}}
            <hr class="border-dark border-t-2">

            {{-- Wrapper untuk daftar artikel --}}
            <div class="space-y-8">
                {{-- Contoh Artikel 1 --}}
                <article class="flex flex-col md:flex-row gap-6 items-center">
                    <a href="#" class="block w-full md:w-1/3 shrink-0">
                        <img src="https://picsum.photos/seed/mentalhealth/800/400" alt="Gambar ilustrasi tentang kesehatan mental" class="w-full h-40 object-cover rounded-playful-lg border-2 border-dark shadow-border-offset">
                    </a>
                    <div>
                        <p class="text-sm font-semibold text-primary mb-1">KESEHATAN MENTAL</p>
                        <a href="#"><h2 class="text-xl font-bold text-dark mb-2 hover:text-primary-dark">5 Cara Sederhana Mengelola Stres di Tempat Kerja</h2></a>
                        <p class="text-xs text-gray-500 mb-3">Oleh Tim Sejenak • 08 Oktober 2025</p>
                        <p class="text-gray-700 text-sm leading-relaxed mb-4 hidden sm:block">
                           Stres di tempat kerja adalah hal yang umum, tapi ada banyak cara efektif untuk mengelolanya...
                        </p>
                        <a href="#" class="font-bold text-primary hover:underline text-sm">Baca Selengkapnya →</a>
                    </div>
                </article>

                {{-- Contoh Artikel 2 --}}
                 <article class="flex flex-col md:flex-row gap-6 items-center">
                    <a href="#" class="block w-full md:w-1/3 shrink-0">
                        <img src="https://picsum.photos/seed/meditation/800/400" alt="Gambar ilustrasi tentang meditasi" class="w-full h-40 object-cover rounded-playful-lg border-2 border-dark shadow-border-offset">
                    </a>
                    <div>
                        <p class="text-sm font-semibold text-indigo-600 mb-1">MEDITASI</p>
                        <a href="#"><h2 class="text-xl font-bold text-dark mb-2 hover:text-indigo-800">Panduan Meditasi 10 Menit untuk Pemula</h2></a>
                        <p class="text-xs text-gray-500 mb-3">Oleh Ayu Lestari • 05 Oktober 2025</p>
                        <p class="text-gray-700 text-sm leading-relaxed mb-4 hidden sm:block">
                           Merasa sulit untuk memulai meditasi? Artikel ini akan memandu Anda langkah demi langkah...
                        </p>
                        <a href="#" class="font-bold text-indigo-600 hover:underline text-sm">Baca Selengkapnya →</a>
                    </div>
                </article>

                {{-- Contoh Artikel 3 --}}
                <article class="flex flex-col md:flex-row gap-6 items-center">
                    <a href="#" class="block w-full md:w-1/3 shrink-0">
                        <img src="https://picsum.photos/seed/selfcare/800/400" alt="Gambar ilustrasi tentang self-care" class="w-full h-40 object-cover rounded-playful-lg border-2 border-dark shadow-border-offset">
                    </a>
                    <div>
                        <p class="text-sm font-semibold text-pink-600 mb-1">PENGEMBANGAN DIRI</p>
                        <a href="#"><h2 class="text-xl font-bold text-dark mb-2 hover:text-pink-800">Membangun Kebiasaan Positif: Di Mana Harus Memulai?</h2></a>
                        <p class="text-xs text-gray-500 mb-3">Oleh Budi Santoso • 01 Oktober 2025</p>
                        <p class="text-gray-700 text-sm leading-relaxed mb-4 hidden sm:block">
                           Membentuk kebiasaan baru bisa terasa menantang. Kuncinya adalah memulai dari yang kecil...
                        </p>
                        <a href="#" class="font-bold text-pink-600 hover:underline text-sm">Baca Selengkapnya →</a>
                    </div>
                </article>

                {{-- Contoh Artikel 4 --}}
                <article class="flex flex-col md:flex-row gap-6 items-center">
                    <a href="#" class="block w-full md:w-1/3 shrink-0">
                        <img src="https://picsum.photos/seed/mentalhealth/800/400" alt="Gambar ilustrasi tentang kesehatan mental" class="w-full h-40 object-cover rounded-playful-lg border-2 border-dark shadow-border-offset">
                    </a>
                    <div>
                        <p class="text-sm font-semibold text-primary mb-1">KESEHATAN MENTAL</p>
                        <a href="#"><h2 class="text-xl font-bold text-dark mb-2 hover:text-primary-dark">5 Cara Sederhana Mengelola Stres di Tempat Kerja</h2></a>
                        <p class="text-xs text-gray-500 mb-3">Oleh Tim Sejenak • 08 Oktober 2025</p>
                        <p class="text-gray-700 text-sm leading-relaxed mb-4 hidden sm:block">
                           Stres di tempat kerja adalah hal yang umum, tapi ada banyak cara efektif untuk mengelolanya...
                        </p>
                        <a href="#" class="font-bold text-primary hover:underline text-sm">Baca Selengkapnya →</a>
                    </div>
                </article>
            </div>

        </div>
    </main>
    
    {{-- KOLOM KANAN (LEBAR 1/3) - SIDEBAR --}}
    <aside class="md:col-span-1 flex flex-col gap-8">
        <div class="bg-primary p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <h3 class="font-bold text-white text-lg mb-2">Tentang Sejenak</h3>
            <p class="text-sm text-gray-800">Sejenak adalah platform untuk membantumu menemukan ketenangan dan bertumbuh menjadi versi terbaik dirimu.</p>
        </div>
        
        <div class="bg-white p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <h3 class="font-bold text-dark text-lg mb-4">Artikel Populer</h3>
            <ul class="space-y-4 text-dark">
                <li><a href="#" class="hover:text-primary transition-colors duration-200">- Mengatasi Overthinking dengan Teknik 'Stop'</a></li>
                <li><a href="#" class="hover:text-primary transition-colors duration-200">- Manfaat Journaling untuk Kesehatan Mental</a></li>
                <li><a href="#" class="hover:text-primary transition-colors duration-200">- 5 Tanda Anda Mengalami 'Burnout'</a></li>
            </ul>
        </div>
    </aside>

</div>
@endsection