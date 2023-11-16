@extends('layouts.user.app')

@section('content')
    <div class="container">
        <h1>Create a New Contact</h1>
        <form method="POST" action="{{ route('user.contacts.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control">
            </div>
            <!-- Add more form fields for other contact information like birthdate, interests, likes, dislikes, etc. -->
            <button type="submit" class="btn btn-primary">Create Contact</button>
        </form>
    </div>
@endsection
