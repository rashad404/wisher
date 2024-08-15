@extends('layouts.user.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold text-gray-900">{{ isset($group) ? 'Edit' : 'Create' }} Group</h1>

    <form method="POST" action="{{ isset($group) ? route('user.groups.update', $group->id) : route('user.groups.store') }}" class="max-w-xl sm:mt-10">
        @csrf
        @if(isset($group))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <!-- Group Name Field -->
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Group Name*</label>
                <div class="mt-2.5">
                    <input type="text" name="name" id="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('name', $group->name ?? '') }}">
                    @if ($errors->has('name'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-10">
            <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                {{ isset($group) ? 'Update' : 'Create' }} Group
            </button>
        </div>
    </form>
</div>
@endsection
