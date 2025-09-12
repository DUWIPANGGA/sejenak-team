@extends('layouts.app')

@section('content')
<div id="exercisePage" class="w-full min-h-screen flex-col md:flex-row bg-background p-4 md:p-12 font-main">
    <div class="flex-1 p-4 md:p-8 flex flex-col items-center justify-center">
        <a href="{{ route('meditasi.main') }}" class="self-start text-dark text-xl mb-6 md:mb-8 md:hidden"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-h1 text-dark text-center text-shadow-h1 mb-8 md:mb-12">Latihan Singkat 🧘‍♀️</h1>

        <div class="w-full max-w-xl bg-white border-2 border-dark rounded-playful-md shadow-border-offset-lg p-6">
            <h2 class="text-h4 text-dark font-bold mb-4">Mini Exercise</h2>
            <a href="{{ route('meditasi.main', ['type' => 'Latihan', 'detail' => 'Latihan Pernapasan 4-7-8']) }}" class="exercise-btn">🌬️ Pernapasan 4-7-8</a>
            <a href="{{ route('meditasi.main', ['type' => 'Latihan', 'detail' => 'Latihan Peregangan Ringan']) }}" class="exercise-btn">🤸 Peregangan Ringan</a>
            <a href="{{ route('meditasi.main', ['type' => 'Latihan', 'detail' => 'Latihan Grounding']) }}" class="exercise-btn">🌱 Grounding</a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Anda bisa tambahkan skrip spesifik untuk halaman ini jika diperlukan
</script>
@endsection