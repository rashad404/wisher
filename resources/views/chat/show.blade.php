@extends('layouts.user.app')

@section('content')
<x-breadcrumbs :links="[
    ['url' => route('main.index'), 'label' => __('Main')],
    ['url' => route('chat.index'), 'label' => __('Chats')],
    ['url' => route('chat.show', $conversation), 'label' => {{ $conversation->user1->id === auth()->id() ? $conversation->user2->name : $conversation->user1->name }}]
]"  />

<div class="container mx-auto pt-6">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <img src="{{ $conversation->user1->id === auth()->id() ? asset($conversation->user2->profile->profile_photo ?? 'images/user.png') : asset($conversation->user1->profile->profile_photo ?? 'images/user.png') }}" class="w-10 h-10 rounded-full mr-3">
            <h2 class="text-xl font-bold">{{ $conversation->user1->id === auth()->id() ? $conversation->user2->name : $conversation->user1->name }}</h2>
        </div>
        <div>
            <button class="text-gray-500" onclick="toggleOptions()">⋮</button>
            <div id="options" class="hidden">
                <form action="{{ route('chat.deleteConversation', $conversation) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete Conversation</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 p-4 rounded-lg mb-4" style="max-height: 500px; overflow-y: auto;">
        @foreach($messages as $message)
            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4">
                <div class="bg-white p-2 rounded-lg shadow-sm max-w-xs">
                    <p>{{ $message->body }}</p>
                    <div class="text-xs text-gray-500 mt-1 flex justify-between items-center">
                        <span>{{ $message->created_at->format('H:i A') }}</span>

                        @if ($message->sender_id === auth()->id())
                            <div class="flex items-center">
                                @if ($message->is_seen)
                                    <span class="ml-2 text-green-500">Seen</span>
                                @endif
                                <button class="ml-2 text-gray-500" onclick="toggleMessageOptions({{ $message->id }})">⋮</button>
                                <div id="message-options-{{ $message->id }}" class="hidden">
                                    <form action="{{ route('chat.deleteMessage', $message) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.storeMessage', $conversation) }}" method="POST">
        @csrf
        <input type="text" name="body" class="w-full p-2 border rounded-lg" placeholder="Type your message">
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
