@extends('layouts.user.app')

@section('content')

<!-- Breadcrumbs -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.events.index'), 'label' => 'Tədbirlərim']
    ]"/>
</div>

<!-- Page Header -->
<div class="px-4 sm:px-6 lg:px-8 pt-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Tədbirlərim</h1>
            <p class="mt-1 text-sm text-gray-600">Tədbir siyahınız.</p>
        </div>
        <div>
            <!-- Add Button with Plus Icon -->
            <a href="{{ route('user.events.create') }}" class="inline-flex items-center px-4 py-2 bg-[#E9654B] text-white text-sm font-semibold rounded-md shadow hover:bg-[#e65b39] focus:outline-none focus:ring-2 focus:ring-[#E9654B] focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Əlavə et
            </a>
        </div>
    </div>
</div>

<!-- Event Table -->
<div class="mt-8 px-4 sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Ad</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tarix</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Təkrarlanma</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 text-right text-sm font-semibold sm:pr-6">Əməliyyat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($events as $event)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <!-- Event Name -->
                        <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                            <a href="{{ route('user.events.show', $event->id) }}" class="text-[#E9654B] hover:text-[#e65b39]">{{ $event->name }}</a>
                        </td>

                        <!-- Event Date -->
                        <td class="px-3 py-4 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}
                        </td>

                        <!-- Event Recurrence -->
                        <td class="px-3 py-4 text-sm text-gray-500">
                            @switch($event->recurrence)
                                @case(1)
                                    İllik
                                    @break
                                @case(2)
                                    Aylıq
                                    @break
                                @default
                                    Yoxdur
                            @endswitch
                        </td>

                        <!-- Event Status -->
                        <td class="px-3 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium
                                @if($event->status == 1)
                                    bg-green-100 text-green-800
                                @else
                                    bg-red-100 text-red-800
                                @endif">
                                {{ $event->status == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="relative py-4 pr-4 text-right text-sm sm:pr-6">
                            <div class="flex space-x-3 justify-end">
                                <!-- Edit Button -->
                                <a href="{{ route('user.events.edit', $event->id) }}" class="text-gray-500 hover:text-gray-700" title="Edit Event">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('user.events.delete', $event->id) }}" method="POST" onsubmit="return confirm('Silmək istədiyinizə əminsinizmi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Event">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
