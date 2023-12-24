@extends('components.layout')

@section('content')

    {{-- <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg" src="/images/nature-pic.jpg" alt="" />
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog['title']}}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$blog['content']}}</p>
        </div>
    </div> --}}
    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
        <div>
            <img class="rounded-lg w-full md:w-64 h-auto" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="">
            <h1 class="text-2xl font-bold mb-2">{{$blog->title}}</h1>
            <p class="text-gray-600">{{$blog->content}}</p>
        </div>
        <div>
            <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-4">
                @foreach($comments as $comment)
                    <div>
                        <p>{{ $comment->content }}</p>
                    </div>
                @endforeach
                <form method="POST" action="/blogs/{{$blog->id}}">
                    @csrf
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full mr-4" src="images/profilepic.jpg" alt="user photo">
                        <div class="flex-1">
                            <textarea name="content" class="w-full bg-gray-100 rounded-lg p-2 focus:outline-none" rows="3" placeholder="Add a comment..."></textarea>
                            <div class="flex items-center justify-between mt-2">
                                <button type="submit" class="text-sm text-blue-500 font-semibold">Post</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
