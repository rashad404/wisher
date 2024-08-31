@extends('layouts.app')

    <!-- Include FontFaceObserver from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontfaceobserver/2.1.0/fontfaceobserver.standalone.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Lobster&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

<!-- Include Heroicons -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Lobster&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

@section('content')

<!-- Breadcrumbs Section -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('wish-photos'), 'label' => __('Wish Photos')],
        ['url' => route('user-wish-photos.create'), 'label' => __('Create Wish Photo')],
    ]"/>
</div>

<div class="container mx-auto p-8 bg-white rounded-lg shadow-lg">
    <!-- Page Title -->
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Create Your Wish Photo</h1>

    <!-- Main Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <!-- Canvas Section -->
        <div class="flex justify-center items-center">
            <div class="w-full max-w-lg">
                <canvas id="editor-canvas" class="border border-gray-300 rounded-md shadow-lg w-full"></canvas>
            </div>
        </div>

        <!-- Controls Section -->
        <div class="flex flex-col gap-6">
            <!-- Action Buttons for Adding and Deleting Text -->
            <div class="flex justify-start gap-4">
                <button id="add-text" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Text
                </button>
                <button id="delete-text" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Delete Text
                </button>
            </div>

            <!-- Text Options Section -->
            <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Text Options</h2>
                <div class="grid grid-cols-2 gap-4">
                    <select id="font-family" class="border border-gray-300 rounded-md p-2 text-sm shadow-sm">
                        <option value="Open Sans">Open Sans</option>
                        <option value="Lobster">Lobster</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                    <select id="font-size" class="border border-gray-300 rounded-md p-2 text-sm shadow-sm">
                        <option value="20">20px</option>
                        <option value="24">24px</option>
                        <!-- Add other sizes... -->
                        <option value="96" selected>96px</option>
                        <option value="128">128px</option>
                    </select>
                    <button id="underline-text" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6v2a6 6 0 0012 0V6M4 20h16" />
                        </svg>
                        Underline
                    </button>
                </div>
            </div>

            <!-- Color Options Section -->
            <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Color Options</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="flex items-center">
                        <label for="text-color" class="mr-2 text-sm font-medium text-gray-700">Color:</label>
                        <input type="color" id="text-color" class="border rounded-md">
                    </div>
                    <div class="flex items-center">
                        <label for="text-background-color" class="mr-2 text-sm font-medium text-gray-700">Background:</label>
                        <input type="color" id="text-background-color" class="border rounded-md" value="#ffffff">
                    </div>
                    <div class="flex items-center">
                        <label for="text-background-opacity" class="mr-2 text-sm font-medium text-gray-700">Opacity:</label>
                        <input type="range" id="text-background-opacity" min="0" max="1" step="0.1" value="1" class="w-24">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-4">
                <!-- Save and Cancel buttons -->
                <button id="save-button" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Wish Photo
                </button>
                <!--  Reset button -->
                <button id="reset-canvas" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-md shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 10h8l3-10h4M16 5a4 4 0 00-8 0" />
                    </svg>
                    Reset
                </button>
                <a id="cancel-button" href="{{ route('user-wish-photos.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-md shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </a>
                
            </div>
            
        </div>
    </div>
</div>

@include('user_wish_photos.js')
@endsection
