<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'trainH-community') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen">
            <!-- Navigation -->
            <header class="bg-white dark:bg-gray-800 shadow">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-dumbbell text-blue-600 text-2xl mr-2"></i>
                            <span class="text-xl font-semibold text-gray-900 dark:text-white">trainH-community</span>
                        </div>
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn-sport bg-blue-600">
                                        <i class="fas fa-tachometer-alt mr-2"></i>
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600">
                                        <i class="fas fa-sign-in-alt mr-1"></i>
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-sport bg-blue-600">
                                            <i class="fas fa-user-plus mr-1"></i>
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </nav>
            </header>

            <!-- Hero Section -->
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold mb-6">Welcome to trainH-community</h1>
                        <p class="text-xl mb-8">Your Ultimate Sports and Training Community</p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('register') }}" class="btn-sport bg-white text-blue-600 hover:bg-gray-100">
                                <i class="fas fa-running mr-2"></i>
                                Start Your Journey
                            </a>
                            <a href="#features" class="btn-sport bg-blue-700 hover:bg-blue-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Decorative pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFF' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="py-16 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Why Choose trainH-community?</h2>
                        <p class="text-gray-600 dark:text-gray-300">Discover the benefits of joining our community</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="sport-card p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Community Support</h3>
                            <p class="text-gray-600 dark:text-gray-400">Connect with like-minded individuals and share your fitness journey</p>
                        </div>
                        <!-- Feature 2 -->
                        <div class="sport-card p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-dumbbell text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Expert Training</h3>
                            <p class="text-gray-600 dark:text-gray-400">Access professional workout plans and training tips</p>
                        </div>
                        <!-- Feature 3 -->
                        <div class="sport-card p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Track Progress</h3>
                            <p class="text-gray-600 dark:text-gray-400">Monitor your fitness goals and celebrate achievements</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-600 dark:text-gray-300">
                            © {{ date('Y') }} trainH-community. All rights reserved.
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600">
                                <i class="fas fa-info-circle mr-2"></i>
                                About
                            </a>
                            <a href="#" class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Privacy
                            </a>
                            <a href="#" class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600">
                                <i class="fas fa-file-contract mr-2"></i>
                                Terms
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
