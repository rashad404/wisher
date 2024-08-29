@extends('layouts.user.app')

@section('content')
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Main')],
        ['url' => route('chat.index'), 'label' => __('Chats')]
    ]"/>

<div class="container mx-auto">
    <h2 class="text-xl font-bold mb-4">Chats</h2>

    <!-- Send Message Button -->
    <div class="mb-4">
        <button onclick="toggleNewMessageModal()" class="bg-blue-500 text-white py-2 px-4 rounded">Send Message</button>
    </div>

    <ul>
        @foreach($conversations as $conversation)
            @php
                $contact = $conversation->user1->id === auth()->id() ? $conversation->user2 : $conversation->user1;
                $lastMessage = $conversation->messages()->orderBy('id', 'desc')->first();
                $lastMessage = $lastMessage ? $lastMessage : (object) ['body' => 'No messages yet', 'created_at' => now()];
            @endphp
            <li class="mb-2 p-2 border-b">
                <a href="{{ route('chat.show', $conversation) }}" class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- User's Profile Photo -->
                        <img src="{{ Storage::url($contact->profile->profile_photo) }}" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold">{{ $contact->name }}</p>
                            <p class="text-sm text-gray-600">{{ Str::limit($lastMessage->body, 30) }}</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $lastMessage->created_at->isToday() ? $lastMessage->created_at->format('H:i A') : $lastMessage->created_at->format('d M Y H:i') }}
                    </div>
                </a>
            </li>
        @endforeach
    </ul>

    <!-- New Message Modal -->
    <div id="newMessageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h3 class="text-xl font-bold mb-4">Start a New Conversation</h3>
            <form action="{{ route('chat.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                    <select name="user_id" id="user_id" class="w-full p-2 border rounded">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="toggleNewMessageModal()" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Start Conversation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleNewMessageModal() {
        document.getElementById('newMessageModal').classList.toggle('hidden');
    }
</script>
@endsection
