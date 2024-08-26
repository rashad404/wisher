<!DOCTYPE html>
<html>
<head>
    <title>Message from {{ config('app.name') }}</title>
</head>
<body>
    <h1>Hello {{ $contact->name }}</h1>
    <p>{{ $messageText }}</p>
</body>
</html>
