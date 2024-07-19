@extends('components.layout')
@section('content')
<section class="bg-white">
    {{-- @include('partials._search') --}}
        {{-- @auth
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
        @endauth --}}
            <div class="my-10 text-center">
                <div class="mb-4">
                    <x-blog-categories :categoriesCsv="$blog->categories" />
                </div>
                <h1 class="text-5xl font-bold mb-2">{{$blog->title}}</h1>
                <div class="flex justify-center items-center space-x-4 p-4 bg-white rounded-lg">
                    <img src="{{ optional($blog->user)->user_img ? asset('storage/' . optional($blog->user)->user_img) : asset('images/profilepic.jpg') }}" alt="Profile Picture" class="w-12 h-12 rounded-full">
                    <div>
                        <div class="font-extrabold text-2xl">{{(($blog->user)->name)}}</div>
                        <div class="text-gray-500">{{$blog->created_at->format('M d, Y')}} &#183; {{$readingTime}} min read</div>
                    </div>
                </div>
                <img class="rounded-lg mx-auto my-auto w-full max-w-3xl h-full" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="">
                <p class="my-8 text-xl text-gray-700 w-1/2 mx-auto text-center leading-relaxed">{{$blog->content}}</p>
            </div>
            <div class="">
                <div class="max-w-lg mx-auto bg-white rounded-lg shadow-xl p-4">
                    @include('blogs.comments', ['comments' => $comments, 'blog' => $blog])
                </div>
            </div>
        </div>
    </section>
@include('partials._footer')
@endsection
