@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('faq.index') }}" class="text-blue-500 hover:text-blue-600">&larr; Back to FAQ</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-semibold mb-6">Create FAQ Item</h1>

            <form action="{{ route('admin.faq.items.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                    <input type="text" name="question" id="question" value="{{ old('question') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('question')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Answer</label>
                    <textarea name="answer" id="answer" rows="5" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Create FAQ Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 