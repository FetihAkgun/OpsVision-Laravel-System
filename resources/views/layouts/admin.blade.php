<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('messages.dashboard')) - {{ __('messages.service_status') }}</title>
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
    <div x-data="{ sidebarOpen: false }">
        <!-- Mobile sidebar overlay -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 md:hidden"
            x-cloak
        ></div>

        <!-- Sidebar -->
        <div 
            x-cloak
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 overflow-y-auto transition duration-300 transform md:translate-x-0 md:static md:h-screen"
            style="position: fixed;">
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-white">
                    {{ __('messages.dashboard') }}
                </a>
                <button @click="sidebarOpen = false" class="text-gray-300 md:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <nav class="mt-5 px-2">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                    {{ __('messages.dashboard') }}
                </a>
                <a href="{{ route('admin.service-groups.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                    {{ __('messages.service_groups') }}
                </a>
                <a href="{{ route('admin.services.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                    {{ __('messages.services') }}
                </a>
                <a href="{{ route('admin.incidents.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                    {{ __('messages.incidents') }}
                </a>
                <a href="{{ route('status.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                    {{ __('messages.view_status_page') }}
                </a>
                
                <!-- Language Switcher -->
                <div class="mt-4 px-2">
                    <div class="text-gray-400 text-sm font-medium mb-2">{{ __('messages.language') }}</div>
                    <div class="flex space-x-2">
                        <a href="{{ route('lang.switch', 'tr') }}" class="px-2 py-1 text-sm rounded-md {{ app()->getLocale() == 'tr' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            {{ __('messages.turkish') }}
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 text-sm rounded-md {{ app()->getLocale() == 'en' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            {{ __('messages.english') }}
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="w-full text-left group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                        {{ __('messages.logout') }}
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col md:pl-64">
            <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
                <button 
                    @click="sidebarOpen = true" 
                    class="h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none"
                >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <main class="flex-1 p-6">
                <div class="mx-auto max-w-7xl">
                    <div class="md:flex md:items-center md:justify-between mb-6">
                        <div class="flex-1 min-w-0">
                            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                @yield('title', __('messages.dashboard'))
                            </h1>
                        </div>
                    </div>

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
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html> 