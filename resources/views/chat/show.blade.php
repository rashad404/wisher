@extends('layouts.user.app')

@section('content')
<!-- Breadcrumbs -->
<x-breadcrumbs :links="[
    ['url' => route('main.index'), 'label' => __('Main')],
    ['url' => route('chat.index'), 'label' => __('Chats')],
    ['url' => route('chat.show', $conversation), 'label' => $conversation->user1->id === auth()->id() ? $conversation->user2->name : $conversation->user1->name]
]" />

<!-- Chat Container -->
<div class="container mx-auto pt-6 max-w-4xl">
    <!-- Chat Header -->
    <div class="flex justify-between items-center mb-4 bg-white p-4 rounded-lg shadow-sm">
        <!-- User Info -->
        <div class="flex items-center">
            <img src="{{ $conversation->user1->id === auth()->id() ? Storage::url($conversation->user2->profile->profile_photo ?? 'default_images/profile.png') : Storage::url($conversation->user1->profile->profile_photo ?? 'default_images/profile.png') }}" class="w-10 h-10 rounded-full mr-3">
            <h2 class="text-xl font-bold text-gray-900">{{ $conversation->user1->id === auth()->id() ? $conversation->user2->name : $conversation->user1->name }}</h2>
        </div>

        <!-- Options Button -->
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-600" onclick="toggleOptions()">⋮</button>
            <div id="options" class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg hidden">
                <form action="{{ route('chat.deleteConversation', $conversation) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this conversation?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="block w-full px-4 py-2 text-left text-red-500 hover:bg-gray-100">Delete Conversation</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Chat Messages -->
    <div class="bg-gray-100 p-4 rounded-lg shadow-sm mb-4" style="max-height: 500px; overflow-y: auto;">
        @foreach($messages as $message)
            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4">
                <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs {{ $message->sender_id === auth()->id() ? 'bg-blue-100' : 'bg-white' }}">
                    <p class="text-gray-800">{{ $message->body }}</p>
                    <div class="text-xs text-gray-500 mt-2 flex justify-between items-center">
                        <span>{{ $message->created_at->format('H:i A') }}</span>

                        @if ($message->sender_id === auth()->id())
                            <div class="flex items-center">
                                @if ($message->is_seen)
                                    <span class="ml-2 text-green-500">Seen</span>
                                @endif
                                <button class="ml-2 text-gray-500 hover:text-gray-600" onclick="toggleMessageOptions({{ $message->id }})">⋮</button>
                                <div id="message-options-{{ $message->id }}" class="absolute right-0 mt-1 w-40 bg-white border rounded-md shadow-lg hidden">
                                    <form action="{{ route('chat.deleteMessage', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full px-4 py-2 text-left text-red-500 hover:bg-gray-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Send Message Form -->
    <form action="{{ route('chat.storeMessage', $conversation) }}" method="POST" class="flex items-center bg-white p-4 rounded-lg shadow-sm">
        @csrf
        <input type="text" name="body" class="flex-grow border border-gray-300 rounded-md px-4 py-2 focus:ring-[#E9654B] focus:border-[#E9654B]" placeholder="Type your message..." required>
        <button type="submit" class="ml-4 bg-[#E9654B] text-white px-4 py-2 rounded-md shadow hover:bg-[#e65b39] transition duration-300">Send</button>
    </form>
</div>
@endsection

<script>
    function toggleOptions() {
        document.getElementById('options').classList.toggle('hidden');
    }

    function toggleMessageOptions(messageId) {
        document.getElementById('message-options-' + messageId).classList.toggle('hidden');
    }
</script>
