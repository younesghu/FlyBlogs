@extends('components.layout')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Notifications</h1>
        @foreach($notifications as $notification)
            <div class="mb-4 p-4 border border-gray-300 rounded">
                {{ $notification->data['message'] }}
                <a href="/blogs/{{ $notification->data['blog_id'] }}" class="text-blue-500">View Blog</a>
            </div>
        @endforeach
    </div>
@endsection
