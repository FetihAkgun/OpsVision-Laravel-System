<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('System Status'))</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('status.index') }}" class="text-2xl font-bold text-gray-900">
                        {{ __('messages.System Status') }}
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900">
                            <span class="mr-2">{{ strtoupper(app()->getLocale()) }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            @foreach(config('app.available_locales', ['en' => 'English', 'tr' => 'Türkçe']) as $locale => $name)
                                <a href="{{ route('lang.switch', $locale) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-gray-900">
                            {{ __('messages.Dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-gray-900">
                                {{ __('messages.Logout') }}
                            </button>
                        </form>
                    @else
                       
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ __('All rights reserved.') }}
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html> 