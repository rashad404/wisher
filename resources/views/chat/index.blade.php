@extends('layouts.user.app')

@section('content')
    <!-- Breadcrumbs -->
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Main')],
        ['url' => route('chat.index'), 'label' => __('Chats')]
    ]"/>

    <!-- Container -->
    <div class="container mx-auto px-4 py-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Chats</h2>
            <button onclick="toggleNewMessageModal()" class="bg-[#E9654B] text-white py-2 px-4 rounded-md shadow hover:bg-[#e65b39] transition duration-300">
                Send Message
            </button>
        </div>

        <!-- Chat List -->
        <ul class="divide-y divide-gray-200 bg-white shadow rounded-lg">
            @foreach($conversations as $conversation)
                @php
                    $contact = $conversation->user1->id === auth()->id() ? $conversation->user2 : $conversation->user1;
                    $lastMessage = $conversation->messages()->orderBy('id', 'desc')->first();
                    $lastMessage = $lastMessage ? $lastMessage : (object) ['body' => 'No messages yet', 'created_at' => now()];
                @endphp
                <li class="px-4 py-4 hover:bg-gray-100 transition duration-200">
                    <a href="{{ route('chat.show', $conversation) }}" class="flex justify-between items-center">
                        <!-- Contact Info -->
                        <div class="flex items-center">
                            <!-- User's Profile Photo -->
                            <img src="{{ Storage::url($contact->profile->profile_photo) }}" alt="{{ $contact->name }}" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-600">{{ Str::limit($lastMessage->body, 30) }}</p>
                            </div>
                        </div>

                        <!-- Last Message Time -->
                        <div class="text-sm text-gray-500">
                            {{ $lastMessage->created_at->isToday() ? $lastMessage->created_at->format('H:i A') : $lastMessage->created_at->format('d M Y H:i') }}
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- New Message Modal -->
        <div id="newMessageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-gray-900">Start a New Conversation</h3>
                <form action="{{ route('chat.create') }}" method="POST">
                    @csrf
                    <!-- User Select -->
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                        <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B]">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="toggleNewMessageModal()" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition duration-300">
                            Cancel
                        </button>
                        <button type="submit" class="bg-[#E9654B] text-white py-2 px-4 rounded-md shadow hover:bg-[#e65b39] transition duration-300">
                            Start Conversation
                        </button>
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
