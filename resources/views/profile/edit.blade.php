@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-user-edit mr-2"></i>
            Edit Profile
        </h1>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 animate-fade-in-down" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6 transform transition-all duration-300 hover:shadow-lg">
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label for="name" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="username" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                        @error('username')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="email" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="birthday" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">Birthday</label>
                        <input type="date" name="birthday" id="birthday" value="{{ old('birthday', optional($user->birthday)->format('Y-m-d')) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                        @error('birthday')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="group">
                    <label for="about_me" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">About Me</label>
                    <textarea name="about_me" id="about_me" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">{{ old('about_me', $user->about_me) }}</textarea>
                    @error('about_me')
                        <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div class="group">
                    <label for="profile_photo" class="block text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors duration-200">Profile Photo</label>
                    <div class="mt-1 flex items-center space-x-6">
                        <div class="flex-shrink-0 relative group">
                            @if($user->profile_photo)
                                <img class="h-24 w-24 rounded-full object-cover ring-4 ring-offset-2 ring-blue-500 transform transition-all duration-300 group-hover:scale-105" 
                                    src="{{ asset('storage/profile-photos/' . $user->profile_photo) }}" 
                                    alt="Current profile photo">
                                <div class="absolute inset-0 rounded-full bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-camera text-white text-xl"></i>
                                </div>
                            @else
                                <div class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center transform transition-all duration-300 group-hover:scale-105">
                                    <span class="text-3xl font-bold text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200">
                            <p class="mt-1 text-xs text-gray-500">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF.</p>
                        </div>
                    </div>
                    @error('profile_photo')
                        <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('profile.show', $user) }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>

            <div class="mt-10 pt-6 border-t border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Delete Account
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                    @csrf
                    @method('delete')

                    <div class="group">
                        <label for="password" class="block text-sm font-medium text-gray-700 group-hover:text-red-600 transition-colors duration-200">Password</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 transition-all duration-200">
                        @error('password', 'userDeletion')
                            <p class="mt-1 text-sm text-red-500 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transform transition-all duration-200 hover:scale-105">
                            <i class="fas fa-trash-alt mr-2"></i>
                            Delete Account
                        </button>
                    </div>
                </form>
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
