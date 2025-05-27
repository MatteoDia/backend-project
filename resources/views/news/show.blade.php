@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('news.index') }}" class="text-blue-500 hover:text-blue-600">&larr; Back to News</a>
        </div>

        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($newsItem->image)
                <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-full h-96 object-cover">
            @endif
            
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $newsItem->title }}</h1>
                
                <div class="flex items-center text-gray-500 mb-6">
                    <span>{{ $newsItem->published_at->format('F d, Y') }}</span>
                    <span class="mx-2">&bull;</span>
                    <span>By {{ $newsItem->author->name }}</span>
                </div>

                <div class="prose max-w-none">
                    {!! nl2br(e($newsItem->content)) !!}
                </div>

                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('admin.news.edit', $newsItem) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                Edit News Item
                            </a>
                            <form action="{{ route('admin.news.destroy', $newsItem) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this news item?')">
                                    Delete News Item
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </article>
    </div>
</div>
@endsection 