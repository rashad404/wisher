@extends('layouts.user.app')

@section('content')

<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Qruplar</h1>
            <p class="mt-2 text-sm text-gray-700">Qrup siyahınız</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('user.groups.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Yeni Qrup Əlavə Et</a>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Ad</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Əlaqələrin Sayı</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Əməliyyat</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($groups as $group)
                            <tr>
                                <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">
                                                <a href="{{ route('user.groups.show', $group->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $group->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                    <div class=“text-gray-900”>{{ $group->contacts()->count() }} Əlaqə</div>
                                </td>
                                <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="{{ route('user.groups.edit', $group->id) }}" class="text-indigo-600 hover:text-indigo-900">Dəyiş<span class="sr-only">, {{ $group->name }}</span></a> |
                                    <a
                                    href="{{ route('user.groups.destroy', $group->id) }}"
                                    onclick="event.preventDefault(); if(confirm('Silmək istədiyinizə əminsinizmi?')) document.getElementById('delete-group-{{ $group->id }}').submit();"
                                    class="text-indigo-600 hover:text-indigo-900">Sil<span class="sr-only">, {{ $group->name }}</span></a>

                                    <form id="delete-group-{{ $group->id }}" action="{{ route('user.groups.destroy', $group->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
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
