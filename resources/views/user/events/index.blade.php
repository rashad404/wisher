@extends('layouts.user.app')

@section('content')
<!-- Breadcrumbs -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.events.index'), 'label' => 'Tədbirlərim']
    ]"/>
</div>

<div class="px-4 sm:px-6 lg:px-8 pt-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Tədbirlərim</h1>
            <p class="mt-2 text-sm text-gray-700">Tədbir siyahınız</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('user.events.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Əlavə et
            </a>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Ad</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tarix</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Təkrarlanma</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Əməliyyat</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($events as $event)
                            <tr>
                                <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="font-medium text-gray-900">
                                        <a href="{{ route('user.events.show', $event->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $event->name }}</a>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                    <div class="text-gray-900">{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                    <div class="text-gray-900">
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
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                    <span class="inline-flex items-center rounded-md
                                        @if($event->status === 1) bg-green-50 text-green-700 ring-green-600/20 @else bg-red-50 text-red-700 ring-red-600/20 @endif
                                        px-2 py-1 text-xs font-medium ring-1 ring-inset">
                                        {{ $event->statusName() }}
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="{{ route('user.events.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900">Dəyiş<span class="sr-only">, {{ $event->name }}</span></a> |
                                    <form action="{{ route('user.events.delete', $event->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Silmək istədiyinizə əminsinizmi?')" class="text-indigo-600 hover:text-indigo-900">Sil<span class="sr-only">, {{ $event->name }}</span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
