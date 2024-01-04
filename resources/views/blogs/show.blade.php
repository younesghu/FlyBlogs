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
                    <div class="flex items-start gap-2.5">
                        <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Jese image">
                        <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">User</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                        </div>
                        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{$comment->content}}</p>
                        </div>
                        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                        </svg>
                        </button>
                        <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                        </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
@endsection
