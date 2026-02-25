<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#16a34a', 
                        primaryHover: '#15803d', 
                        darkBg: '#0f172a',
                        cardBg: '#1e293b',
                    }
                }
            }
        }
    </script>

    <style>
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            background-color: #f0fdf4;
            background-image: radial-gradient(#86efac 1px, transparent 1px); 
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="antialiased text-slate-600 h-screen flex flex-col justify-center items-center overflow-hidden relative">

    <div class="absolute top-0 left-0 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-32 left-20 w-64 h-64 bg-lime-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="relative z-10 max-w-lg w-full px-6 text-center fade-in-up">
        
        <h1 class="text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-teal-500 drop-shadow-sm">
            @yield('code', 'Error')
        </h1>

        <div class="mt-4">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">
                @yield('title')
            </h2>
            <p class="mt-3 text-base text-slate-500 font-medium">
                @yield('message')
            </p>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ url('/') }}" class="w-full sm:w-auto px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-full transition duration-300 shadow-lg hover:shadow-green-500/30 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Beranda
            </a>
            
            <button onclick="window.history.back()" class="w-full sm:w-auto px-8 py-3 bg-white hover:bg-slate-50 text-slate-700 font-semibold rounded-full border border-slate-200 transition duration-300 shadow-sm hover:shadow-md">
                Halaman Sebelumnya
            </button>
        </div>

        <div class="mt-12 text-sm text-slate-400">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>

</body>
</html>