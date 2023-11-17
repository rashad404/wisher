@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4">Products</h1>
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <li class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset("storage/" . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                            <p class="text-gray-600">{{ $product->description }}</p>
                            <p class="mt-2 text-lg font-semibold">${{ $product->price }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
