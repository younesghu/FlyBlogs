@extends('components.layout')

@section('content')
    @auth
        @if(auth()->user()->id === $blog->user_id)
            <a href="/blogs/{{$blog->id}}/edit">
                <i class="fa-solid fa-pencil mb-3" ></i> Edit
            </a>
            <form method="POST" action="/blogs/{{$blog->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash mt-3"></i> Delete</button>
            </form>
        @endif
    @endauth
    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
        <div class="text-center">
            <img class="rounded-lg mx-auto my-auto md:w-64 h-auto" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="">
            <h1 class="text-2xl font-bold mb-2">{{$blog->title}}</h1>
            <p class="text-gray-600">{{$blog->content}}</p>
        </div>
        <div>
            <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-4">
                @include('blogs.comments', ['comments' => $comments, 'blog' => $blog])
            </div>
        </div>
    </div>

@endsection


