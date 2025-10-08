@extends('layouts.admin')

@section('title', 'Manajemen Blog')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-h2 font-bold text-dark">Manajemen Blog</h1>
            <p class="text-gray-600 mt-1">Kelola blog untuk memberikan informasi dan tips.</p>
        </div>
        <a href="{{ route('admin.audios.create') }}" class="mt-4 sm:mt-0 inline-block px-6 py-3 bg-primary text-white font-bold text-center rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-green-600">
            <i class="fas fa-plus mr-2"></i> Tambah Blog Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-2 border-dark text-green-800 font-semibold px-4 py-3 rounded-playful-sm shadow-border-offset mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 sm:p-6 rounded-playful-sm border-2 border-dark shadow-border-offset">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        </div>

        <div class="mt-8">
            
        </div>
    </div>
</div>
@endsection