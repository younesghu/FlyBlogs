@extends('components.layout')

@section('content')
@include('partials._search')
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            <a href="/blogs/{{$blog['id']}}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="images/nature-pic.jpg" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog['title']}}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$blog['content']}}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$blog['categories']}}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-6 p-4">
        {{$blogs->links()}}
    </div>
@endsection
