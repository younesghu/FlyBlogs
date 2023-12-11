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
            <img class="rounded-lg w-full md:w-64 h-auto" src="/images/nature-pic.jpg" alt="Nature Image">
            <h1 class="text-2xl font-bold mb-2">{{$blog['title']}}</h1>
            <p class="text-gray-600">{{$blog['content']}}</p>
        </div>
        <div>
            comments will appear here!
        </div>
    </div>


@endsection
