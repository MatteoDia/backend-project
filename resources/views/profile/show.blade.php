@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        @if($user->profile_photo)
                            <img class="h-32 w-32 rounded-full object-cover" 
                                src="{{ asset('storage/profile-photos/' . $user->profile_photo) }}" 
                                alt="{{ $user->name }}'s profile photo">
                        @else
                            <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-4xl text-gray-400">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-500">{{ '@' . $user->username }}</p>
                        @if($user->isAdmin())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                Admin
                            </span>
                        @endif
                    </div>
                </div>

                @if($user->about_me)
                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-gray-900">About Me</h2>
                        <p class="mt-2 text-gray-600 whitespace-pre-wrap">{{ $user->about_me }}</p>
                    </div>
                @endif

                <div class="mt-6 grid grid-cols-2 gap-6 border-t border-gray-200 pt-6">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Member since</h2>
                        <p class="mt-1 text-gray-900">{{ $user->created_at->format('F Y') }}</p>
                    </div>
                    @if($user->birthday)
                        <div>
                            <h2 class="text-sm font-medium text-gray-500">Birthday</h2>
                            <p class="mt-1 text-gray-900">{{ $user->birthday->format('F j') }}</p>
                        </div>
                    @endif
                </div>

                @if(Auth::id() === $user->id)
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Edit Profile
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 