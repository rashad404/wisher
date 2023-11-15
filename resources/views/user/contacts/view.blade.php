
@extends('layouts.dashboard.app')

@section('content')



  <div class="flex transform-gpu divide-x divide-gray-100">
  
    <!-- Active item side-panel, show/hide based on active state -->
    <div class="hidden h-96 w-1/2 flex-none flex-col divide-y divide-gray-100 overflow-y-auto sm:flex">
      <div class="flex-none p-6 text-center">
        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="mx-auto h-16 w-16 rounded-full">
        <h2 class="mt-3 font-semibold text-gray-900">Tom Cook</h2>
        <p class="text-sm leading-6 text-gray-500">Director, Product Development</p>
      </div>
      <div class="flex flex-auto flex-col justify-between p-6">
        <dl class="grid grid-cols-1 gap-x-6 gap-y-3 text-sm text-gray-700">
          <dt class="col-end-1 font-semibold text-gray-900">Phone</dt>
          <dd>881-460-8515</dd>
          <dt class="col-end-1 font-semibold text-gray-900">URL</dt>
          <dd class="truncate"><a href="https://example.com" class="text-indigo-600 underline">https://example.com</a></dd>
          <dt class="col-end-1 font-semibold text-gray-900">Email</dt>
          <dd class="truncate"><a href="#" class="text-indigo-600 underline">tomcook@example.com</a></dd>
        </dl>
        <button type="button" class="mt-6 w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send message</button>
      </div>
    </div>
  </div>

  
  
@endsection