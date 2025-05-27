@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-envelope text-blue-600 mr-3"></i>
            Contact Us
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 animate-fade-in-down" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 animate-fade-in-down" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8 transform transition-all duration-300 hover:shadow-xl">
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label for="name" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">
                            <i class="fas fa-user text-gray-400 mr-2"></i>
                            Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200 @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="email" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200 @error('email') border-red-300 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="group">
                    <label for="subject" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-heading text-gray-400 mr-2"></i>
                        Subject
                    </label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200 @error('subject') border-red-300 @enderror">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div class="group">
                    <label for="message" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-comment text-gray-400 mr-2"></i>
                        Message
                    </label>
                    <textarea name="message" id="message" rows="6" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200 @error('message') border-red-300 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-map-marker-alt text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Our Location</h3>
                <p class="text-gray-600">123 Sport Street, Fitness City, FC 12345</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-phone text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Phone</h3>
                <p class="text-gray-600">+1 (234) 567-8900</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Email</h3>
                <p class="text-gray-600">info@trainh-community.com</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.5s ease-out;
    }
</style>
@endsection 