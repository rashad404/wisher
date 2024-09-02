@extends('layouts.user.app')

@section('content')
<x-resource-index
    :title="'Qruplar'"
    :subtitle="'Qrup siyahınız'"
    :createRoute="route('user.groups.create')"
    :bulkDeleteRoute="route('user.groups.bulk-delete')"
    :bulkStatusUpdateRoute="route('user.groups.bulk-status-update')"
    :searchRoute="route('user.groups.index')"
    :items="$groups"
>
    <x-slot name="breadcrumbs">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.groups.index'), 'label' => 'Groups'],
        ]"/>
    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('user.groups.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Yeni Qrup Əlavə Et
        </a>
    </x-slot>

    <x-slot name="list">
        <ul class="divide-y divide-gray-200">
            @forelse($groups as $group)
                <li class="hover:bg-gray-50">
                    <div class="px-4 py-4 sm:px-6 flex items-center">
                        <div class="flex-shrink-0 mr-4">
                            <input type="checkbox" name="selected_groups[]" value="{{ $group->id }}" class="resource-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="flex-grow flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <svg class="h-12 w-12 rounded-full bg-gray-300 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                        <a href="{{ route('user.groups.show', $group->id) }}">{{ $group->name }}</a>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $group->contacts()->count() }} Əlaqə
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                @if ($group->status == 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                                <div class="flex space-x-2">
                                    <a href="{{ route('user.groups.edit', $group->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('user.groups.destroy', $group->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Silmək istədiyinizə əminsinizmi?')" class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="px-4 py-4 sm:px-6 text-center text-gray-500">
                    No groups found.
                </li>
            @endforelse
        </ul>
    </x-slot>
</x-resource-index>
@endsection