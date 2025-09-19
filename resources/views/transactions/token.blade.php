@extends('layouts.app')

@section('title', 'Top Up Token')

@section('content')
<div class="flex flex-col items-center w-full h-full p-4 md:p-0 overflow-y-auto m-0 p-0">
    <div class="text-center my-8 md:my-12">
        <h1 class="text-4xl md:text-5xl font-bold font-exo2 text-dark text-shadow-h1">Pilih Paket Token</h1>
        <p class="text-lg md:text-xl text-gray-600 mt-2 font-poppins text-shadow-soft">Temukan paket yang paling cocok untuk kebutuhan curhatmu!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 w-full max-w-6xl px-4 pb-8">

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-primary mb-4"><i class="fas fa-seedling"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Basic</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">50 Token</p>
            <p class="text-3xl font-bold font-exo2 text-dark mb-6">Rp 10.000</p>
            <button class="w-full bg-primary text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-primary-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-secondary mb-4"><i class="fas fa-piggy-bank"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Hemat</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">120 Token</p>
            <p class="text-3xl font-bold font-exo2 text-dark mb-6">Rp 20.000</p>
            <button class="w-full bg-secondary text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-secondary-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-orange mb-4"><i class="fas fa-gift"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Medium</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">250 Token</p>
            <p class="text-3xl font-bold font-exo2 text-dark mb-6">Rp 40.000</p>
            <button class="w-full bg-orange text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-orange-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-primary mb-4"><i class="fas fa-star"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Mega</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">550 Token</p>
            <p class="text-3xl font-bold font-exo2 text-dark mb-6">Rp 80.000</p>
            <button class="w-full bg-primary text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-primary-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-secondary mb-4"><i class="fas fa-fire"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Super</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">1.200 Token</p>
            <p class="text-3xl font-bold font-exo2 text-dark mb-6">Rp 150.000</p>
            <button class="w-full bg-secondary text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-secondary-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-orange mb-4"><i class="fas fa-rocket"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Ultimate</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">3.000 Token</p>
            <p class="text-4xl font-bold font-exo2 text-dark mb-6">Rp 300.000</p>
            <button class="w-full bg-orange text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-orange-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-primary mb-4"><i class="fas fa-heart"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Keluarga</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">5.000 Token</p>
            <p class="text-4xl font-bold font-exo2 text-dark mb-6">Rp 450.000</p>
            <button class="w-full bg-primary text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-primary-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>
        
        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-secondary mb-4"><i class="fas fa-calendar-alt"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Tahunan</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">10.000 Token</p>
            <p class="text-4xl font-bold font-exo2 text-dark mb-6">Rp 800.000</p>
            <button class="w-full bg-secondary text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-secondary-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>

        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300">
            <div class="text-4xl text-orange mb-4"><i class="fas fa-infinity"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Sejenak</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">25.000 Token</p>
            <p class="text-4xl font-bold font-exo2 text-dark mb-6">Rp 1.500.000</p>
            <button class="w-full bg-orange text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-orange-dark transition-all duration-200 hover:scale-105">Beli Sekarang</button>
        </div>
        
        <div class="bg-white border-2 border-dark rounded-playful-lg p-6 flex flex-col items-center text-center shadow-border-offset-lg hover:shadow-border-offset-accent transition-shadow duration-300 col-span-1 md:col-span-2 lg:col-span-3">
            <div class="text-4xl text-purple mb-4"><i class="fas fa-briefcase"></i></div>
            <h2 class="text-2xl font-bold font-exo2 text-dark">Paket Khusus</h2>
            <p class="text-lg text-gray-500 font-poppins mb-2">Paket kustom untuk komunitas atau perusahaan</p>
            <p class="text-4xl font-bold font-exo2 text-dark mb-6">Hubungi Kami</p>
            <button class="w-full bg-purple text-white p-3 rounded-playful-sm font-bold border-2 border-dark shadow-[4px_4px_0px_#080330] hover:bg-purple-dark transition-all duration-200 hover:scale-105">Kirim Pertanyaan</button>
        </div>
    </div>
</div>
@endsection