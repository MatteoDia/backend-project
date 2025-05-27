<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'trainH-community') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome for sports icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Sport Theme Styles -->
        <style>
            :root {
                --primary-color: #1e40af;
                --secondary-color: #3b82f6;
                --accent-color: #f97316;
            }
            
            .sport-gradient {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
                position: relative;
                overflow: hidden;
            }
            
            .sport-gradient::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h20v20H0z" fill="none"/><circle cx="10" cy="10" r="8" stroke="rgba(255,255,255,0.1)" fill="none"/></svg>') repeat;
                opacity: 0.3;
            }

            .sport-card {
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                background: white;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            .sport-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .nav-link {
                position: relative;
                transition: color 0.3s ease;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--accent-color);
                transition: width 0.3s ease;
            }

            .nav-link:hover::after {
                width: 100%;
            }

            .btn-sport {
                background: var(--accent-color);
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }

            .btn-sport:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.3);
            }

            /* Animated background for active sections */
            .active-section {
                position: relative;
                overflow: hidden;
            }

            .active-section::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 200%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                animation: shine 2s infinite;
            }

            @keyframes shine {
                to {
                    left: 100%;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="sport-gradient shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-dumbbell mr-2"></i>
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @if (isset($slot))
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endif
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-auto">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-600">
                            © {{ date('Y') }} trainH-community. All rights reserved.
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="nav-link text-gray-600 hover:text-blue-600 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                About
                            </a>
                            <a href="#" class="nav-link text-gray-600 hover:text-blue-600 flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Privacy
                            </a>
                            <a href="#" class="nav-link text-gray-600 hover:text-blue-600 flex items-center">
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
