<script src="https://cdn.tailwindcss.com"></script>

@extends('components.layout')

@section('content')
    <a href="/blogs/{{$blog->id}}/edit">
        <i class="fa-solid fa-pencil mb-3" ></i> Edit
    </a>
    <form method="POST" action="/blogs/{{$blog->id}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500"><i class="fa-solid fa-trash mt-3"></i> Delete</button>
    </form>
    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
        <div class="text-center">
            <img class="rounded-lg mx-auto my-auto md:w-64 h-auto" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="">
            <h1 class="text-2xl font-bold mb-2">{{$blog->title}}</h1>
            <p class="text-gray-600">{{$blog->content}}</p>
        </div>
        <div>
            <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-4">
                @foreach($comments as $comment)
                <div class="flex items-start mb-4">
                    <img src="{{$comment->user->user_img ? asset('storage/' . $comment->user->user_img) : asset('images/profilepic.jpg')}}" alt="Profile" class="w-8 h-8 rounded-full mr-3">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h5 class="text-gray-800 font-semibold">{{$comment->user->name}}</h5>
                            <span class="text-gray-500 text-xs">
                                {{$comment->created_at->diffForHumans()}}
                            </span>
                            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray rounded-lg hover:bg-gray-100" type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                </svg>
                            </button>

                            <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                    <li>
                                    <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                    <form action="/blogs/{{$blog->id}}/comments/{{$comment->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="submit">Delete</button>
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-gray-700">{{$comment->content}}</p>
                    </div>
                </div>
                @endforeach
                <form method="POST" action="/blogs/{{$blog->id}}">
                    @csrf
                    <div class="flex items-center">
                        <img src="{{auth()->user()->user_img ? asset('storage/' . auth()->user()->user_img) : asset('images/profilepic.jpg')}}" alt="Profile" class="w-8 h-8 rounded-full mr-3">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection


