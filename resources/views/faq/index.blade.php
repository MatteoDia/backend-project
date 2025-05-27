@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-question-circle text-blue-600 mr-3"></i>
                Frequently Asked Questions
            </h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="space-x-4">
                        <a href="{{ route('admin.faq.categories.create') }}" class="btn-sport bg-blue-600">
                            <i class="fas fa-folder-plus mr-2"></i>
                            Add Category
                        </a>
                        <a href="{{ route('admin.faq.items.create') }}" class="btn-sport bg-green-600">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Add FAQ Item
                        </a>
                    </div>
                @endif
            @endauth
        </div>

        @foreach($categories as $category)
            <div class="mb-8 sport-card">
                <div class="sport-gradient px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-trophy mr-2"></i>
                        {{ $category->name }}
                    </h2>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex space-x-4">
                                <a href="{{ route('admin.faq.categories.edit', $category) }}" class="text-white hover:text-yellow-300 transition duration-300">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.faq.categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white hover:text-red-300 transition duration-300" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach($category->faqItems->sortBy('order') as $item)
                        <div class="p-6 hover:bg-gray-50 transition duration-300" x-data="{ open: false }">
                            <div class="flex justify-between items-start">
                                <button @click="open = !open" class="text-left font-medium text-gray-900 hover:text-blue-600 flex-1 flex items-center">
                                    <i class="fas" :class="{ 'fa-chevron-down': !open, 'fa-chevron-up': open }"></i>
                                    <span class="ml-3">{{ $item->question }}</span>
                                </button>
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <div class="flex items-center space-x-4 ml-4">
                                            @if(!$loop->first)
                                                <form action="{{ route('admin.faq.items.move-up', $item) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-gray-500 hover:text-blue-600 transition duration-300">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if(!$loop->last)
                                                <form action="{{ route('admin.faq.items.move-down', $item) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-gray-500 hover:text-blue-600 transition duration-300">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.faq.items.edit', $item) }}" class="text-yellow-500 hover:text-yellow-600 transition duration-300">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.faq.items.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600 transition duration-300" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                            <div x-show="open" x-transition class="mt-4 text-gray-600 pl-8">
                                {{ $item->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 