@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-newspaper text-blue-600 mr-3"></i>
            Latest News
        </h1>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.news.create') }}" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-md shadow-lg transform transition-all duration-200 hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create News Item
                </a>
            @endif
        @endauth
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($newsItems as $item)
            <article class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                @if($item->image)
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                            alt="{{ $item->title }}" 
                            class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-4xl"></i>
                    </div>
                @endif
                
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800 hover:text-blue-600 transition-colors duration-200">
                        {{ $item->title }}
                    </h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($item->content, 150) }}</p>
                    
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                @if($item->author->profile_photo)
                                    <img src="{{ asset('storage/profile-photos/' . $item->author->profile_photo) }}" 
                                        alt="{{ $item->author->name }}" 
                                        class="w-8 h-8 rounded-full object-cover mr-2">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center mr-2">
                                        <span class="text-white font-semibold">
                                            {{ strtoupper(substr($item->author->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <span>{{ $item->author->name }}</span>
                            </div>
                            <span class="text-gray-400">•</span>
                            <time datetime="{{ $item->published_at->format('Y-m-d') }}">
                                {{ $item->published_at->format('M d, Y') }}
                            </time>
                        </div>
                        
                        <a href="{{ route('news.show', $item) }}" 
                            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                            Read more
                            <i class="fas fa-arrow-right ml-2 transform transition-transform duration-200 group-hover:translate-x-1"></i>
                        </a>
                    </div>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="mt-4 pt-4 border-t border-gray-100 flex space-x-4">
                                <a href="{{ route('admin.news.edit', $item) }}" 
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-700 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-flex items-center text-red-600 hover:text-red-700 transition-colors duration-200" 
                                        onclick="return confirm('Are you sure you want to delete this news item?')">
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $newsItems->links() }}
    </div>
</div>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection 