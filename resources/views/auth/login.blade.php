<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sejenak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');

        body {
            font-family: 'Lexend', sans-serif;
        }

        /* Custom shadow and border radius for a playful look */
        .shadow-offset-dark {
            box-shadow: 3px 4px 0px #080330;
        }
        .shadow-offset-primary {
            box-shadow: 3px 4px 0px #8FD14F;
        }
        .rounded-playful {
            border-radius: 12px;
        }
        .text-shadow-h1 {
            color: white;
            text-shadow:
                -1px -1px 0 #080330,
                1px -1px 0 #080330,
                -1px 1px 0 #080330,
                1px 1px 0 #080330,
                3px 3px 0 #080330;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8FD14F',
                        dark: '#080330',
                        lightbg: '#f7f7f7',
                        logininput: '#e6d09c',
                        placeholder: '#d6d9e1',
                    },
                    fontFamily: {
                        lexend: ['Lexend', 'sans-serif'],
                    },
                    borderRadius: {
                        'card-lg': '24px',
                    },
                },
            },
        };
    </script>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="flex h-screen w-screen">
        <div class="hidden md:flex flex-col items-center justify-center p-8 bg-primary w-1/2 relative text-white text-center">
            <h1 class="text-4xl font-bold mb-4 text-shadow-h1">Luangkan waktu refleksi cukup sejenak saja</h1>
            <div class="relative w-64 h-64 bg-[#f1e5c2] border-4 border-dark my-8 overflow-hidden">
                <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <path class="fill-[#f1e5c2] stroke-dark stroke-[2px]" d="M 0,0 L 100,0 L 100,100 C 95,95 85,95 80,100 C 75,95 65,95 60,100 C 55,95 45,95 40,100 C 35,95 25,95 20,100 C 15,95 5,95 0,100 Z" vector-effect="non-scaling-stroke"/>
                </svg>
            </div>
            <p class="text-sm font-light">Perjalanan menuju kesejahteraan emosional dimulai di sini.</p>
        </div>

        <div class="flex-1 flex items-center justify-center p-4 bg-lightbg md:w-1/2">
            <div class="w-full max-w-sm p-6 md:p-8 bg-white rounded-card-lg border-4 border-dark shadow-offset-dark">

                <x-validation-errors class="mb-4" />

                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                @endsession

                <div class="flex flex-col justify-start w-full">
                    <a href="#" class="text-dark hover:text-gray-900 mb-4 flex items-center text-sm">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <h2 class="text-3xl font-bold mb-1 text-dark">Welcome back!</h2>
                    <p class="text-sm mb-6 text-dark">Tolong login kembali kedalam akun anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-dark mb-1">Email</label>
                        <input id="email" class="block w-full rounded-playful border-2 border-dark shadow-offset-dark p-2 bg-logininput placeholder-placeholder focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Email Anda" />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-dark mb-1">Kata sandi</label>
                        <input id="password" class="block w-full rounded-playful border-2 border-dark shadow-offset-dark p-2 bg-logininput placeholder-placeholder focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan Kata Sandi" />
                    </div>

                    <div class="flex justify-between items-center mt-4 mb-6">
                        <label for="remember_me" class="flex items-center text-sm text-dark">
                            <input id="remember_me" type="checkbox" class="h-4 w-4 text-primary border-2 border-dark rounded checked:bg-primary focus:ring-primary" name="remember">
                            <span class="ms-2">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-dark hover:text-gray-900" href="{{ route('password.request') }}">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="w-full px-4 py-2 font-bold text-dark bg-primary rounded-playful border-2 border-dark shadow-offset-dark transition-all duration-200 hover:bg-[#a9d1a9] hover:shadow-[3px_4px_0_#080330]">
                            Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6 text-sm">
                    <p>Tidak punya akun?
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-dark font-bold underline">Daftar disini</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>