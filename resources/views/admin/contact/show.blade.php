@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Message Details</h1>
            <a href="{{ route('admin.contact.index') }}" class="text-blue-500 hover:text-blue-700">
                &larr; Back to Messages
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">From</h3>
                    <p class="mt-1 text-lg">{{ $message->name }}</p>
                    <p class="text-blue-600">{{ $message->email }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Date</h3>
                    <p class="mt-1">{{ $message->created_at->format('F j, Y g:i A') }}</p>
                    <p class="mt-1">
                        @if($message->is_read)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Read</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Unread</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-500">Subject</h3>
                <p class="mt-1 text-lg font-medium">{{ $message->subject }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-500">Message</h3>
                <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                    <p class="whitespace-pre-wrap">{{ $message->message }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                <div class="flex space-x-4">
                    @if($message->is_read)
                        <form action="{{ route('admin.contact.unread', $message) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-yellow-600 hover:text-yellow-900 font-medium">
                                Mark as Unread
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.contact.read', $message) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-900 font-medium">
                                Mark as Read
                            </button>
                        </form>
                    @endif
                </div>
                <form action="{{ route('admin.contact.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                        Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 