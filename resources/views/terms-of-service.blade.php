@extends('layouts.guest')
@section('title', 'Ketentuan Layanan - Sejenak')

@section('content')
<div class="flex flex-col items-center h-full w-full overflow-x-hidden no-scrollbar z-10">

    {{-- Header Section --}}
    <section class="w-full py-20 text-center text-white bg-primary">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-black leading-tight mb-4">
            Ketentuan Layanan
        </h1>
        <p class="text-lg md:text-xl font-medium text-black max-w-2xl mx-auto">
            Selamat datang di Sejenak. Dengan menggunakan platform kami, Anda menyetujui ketentuan berikut.
        </p>
    </section>

    {{-- SEPARATOR 1: SCROLLING KE KIRI --}}
    <div class="separator-scrolling-bg w-full h-14 bg-[url('assets/component/buy_now_banner.svg')] bg-repeat-x bg-[length:auto_120%] bg-[position:0_-4px] relative -top-7 -rotate-2 bg-white border-[6px] border-black">
    </div>

    {{-- Content Section --}}
    <section id="terms-content" class="w-full flex justify-center py-20 px-4 sm:px-8 lg:px-20 bg-gray-50">
        <div class="max-w-4xl w-full text-black text-base md:text-lg leading-relaxed space-y-8">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 border-b-2 border-black pb-2">1. Penerimaan Ketentuan</h2>
            <p>
                Dengan mengakses dan menggunakan platform **Sejenak**, Anda mengakui telah membaca, memahami, dan menyetujui semua ketentuan yang diuraikan di sini. Jika Anda tidak setuju dengan ketentuan ini, Anda dilarang menggunakan platform ini.
            </p>

            <h2 class="text-2xl md:text-3xl font-bold mb-4 border-b-2 border-black pb-2">2. Sifat Layanan</h2>
            <p>
                **Sejenak** adalah platform yang dirancang untuk refleksi diri, ekspresi pribadi, dan koneksi komunitas. Layanan yang kami sediakan, termasuk chatbot AI dan panduan aktivitas, **bukanlah layanan profesional kesehatan mental, diagnosis medis, atau terapi**. Konten apa pun di platform ini tidak boleh dianggap sebagai pengganti nasihat, diagnosis, atau perawatan medis dari profesional berlisensi.
            </p>
            <p>
                Jika Anda menghadapi kondisi darurat atau membutuhkan bantuan profesional, Anda harus segera menghubungi profesional kesehatan atau layanan darurat yang relevan.
            </p>

            <h2 class="text-2xl md:text-3xl font-bold mb-4 border-b-2 border-black pb-2">3. Privasi dan Keamanan</h2>
            <p>
                Kami sangat menghargai privasi Anda. Data yang Anda masukkan ke dalam jurnal pribadi Anda, termasuk riwayat chat dengan AI, dienkripsi secara end-to-end. Kami tidak membaca, membagikan, atau menggunakan data pribadi ini untuk tujuan lain selain untuk menyediakan layanan kepada Anda. Informasi lebih lanjut dapat ditemukan dalam Kebijakan Privasi kami.
            </p>

            <h2 class="text-2xl md:text-3xl font-bold mb-4 border-b-2 border-black pb-2">4. Tanggung Jawab Pengguna</h2>
            <p>
                Anda bertanggung jawab penuh atas konten yang Anda bagikan di forum publik dan interaksi Anda dengan pengguna lain. Anda dilarang memposting konten ilegal, berbahaya, atau merusak, termasuk namun tidak terbatas pada:
            </p>
            <ul class="list-disc list-inside space-y-2 pl-4">
                <li>Ujaran kebencian, pelecehan, atau ancaman.</li>
                <li>Informasi pribadi orang lain tanpa izin.</li>
                <li>Konten yang mempromosikan kekerasan atau melukai diri sendiri.</li>
            </ul>

            <h2 class="text-2xl md:text-3xl font-bold mb-4 border-b-2 border-black pb-2">5. Pembatasan Tanggung Jawab</h2>
            <p>
                **Sejenak** dan para pengembangnya tidak bertanggung jawab atas kerugian langsung atau tidak langsung yang timbul dari penggunaan atau ketidakmampuan menggunakan layanan kami. Kami tidak menjamin keakuratan atau keandalan konten yang diposting oleh pengguna lain.
            </p>

            <h2 class="text-2xl md:text-3xl font-bold mb-4 border-b-2 border-black pb-2">6. Perubahan Ketentuan</h2>
            <p>
                Kami berhak untuk mengubah ketentuan layanan ini kapan saja. Perubahan akan berlaku segera setelah dipublikasikan di halaman ini. Penggunaan platform secara terus-menerus setelah perubahan menandakan persetujuan Anda terhadap ketentuan yang baru.
            </p>
        </div>
    </section>

    {{-- SEPARATOR 2: SCROLLING KE KANAN --}}
    <div class="separator-scrolling-bg-right w-full h-14 bg-[url('assets/component/buy_now_banner.svg')] bg-repeat-x bg-[length:auto_120%] bg-[position:0_-4px] relative -top-7 rotate-2 bg-white border-[6px] border-black">
    </div>

    {{-- CTA Section --}}
    <section id="cta-section" class="w-full flex-1 flex justify-center py-20 bg-primary">
        <div class="w-full md:w-[70%] text-center p-8">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-black mb-4">
                Punya pertanyaan?
            </h2>
            <p class="text-base md:text-lg text-black font-medium mb-8 max-w-xl mx-auto">
                Silakan hubungi tim kami untuk informasi lebih lanjut.
            </p>
            <a href="#" class="nav-btn py-3 px-8 rounded-full text-white font-bold bg-accent border-2 border-black cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-[5px_5px_0_#080330] hover:bg-secondary">
                Hubungi Kami
            </a>
        </div>
    </section>

</div>
@endsection

@section('script')
<script>
    // Script tambahan jika diperlukan
</script>
<style>
    /* KEYFRAMES dan gaya dari kode sebelumnya tetap dipertahankan di sini */
    @keyframes background-scrolling-left {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -100% 0;
        }
    }

    @keyframes background-scrolling-right {
        from {
            background-position: -100% 0;
        }
        to {
            background-position: 0 0;
        }
    }

    .separator-scrolling-bg {
        animation: background-scrolling-left 20s linear infinite;
        will-change: background-position;
    }

    .separator-scrolling-bg-right {
        animation: background-scrolling-right 20s linear infinite;
        will-change: background-position;
    }
</style>
@endsection