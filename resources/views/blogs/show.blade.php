<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layout.layout')

@section('content')

    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg" src="/images/nature-pic.jpg" alt="" />
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog['title']}}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$blog['content']}}</p>
        </div>
    </div>
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img class="rounded-t-lg" src="/images/nature-pic.jpg" alt="" />
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog['title']}}</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$blog['content']}}</p>
    </div>
</div>
{{-- <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> --}}
        {{-- Edit Product link --}}
        {{-- <a href="/products/{{$product->id}}/edit">
            <i class="fa-solid fa-pencil mb-3" ></i> Edit
        </a> --}}
        {{-- Delete Product link added to Manage Products --}}
        {{-- <form method="POST" action="/products/{{$product->id}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash mt-3"></i> Delete</button>
        </form> --}}
        {{-- <div
            class="flex flex-col items-center justify-center text-center"
        >
            <img
                class="mb-6 rounded-t-lg"
                src="/images/nature-pic.jpg"
                alt=""
            />
            <h3 class="text-2xl mb-2">{{$blog['title']}}</h3>
            <p>
                {{$blog['content']}}
            </p>

        </div>
        <div
            class="flex flex-col items-center justify-center text-center"
        >
            <img
                class="mb-6 rounded-t-lg"
                src="/images/nature-pic.jpg"
                alt=""
            />
            <h3 class="text-2xl mb-2">{{$blog['title']}}</h3>
            <p>
                {{$blog['content']}}
            </p>

        </div>

</div> --}}
@endsection
</body>
</html>
