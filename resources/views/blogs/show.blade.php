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

    {{-- <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg" src="/images/nature-pic.jpg" alt="" />
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog['title']}}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$blog['content']}}</p>
        </div>
    </div> --}}
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="" alt="">
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="/images/nature-pic.jpg" alt="">
        </div>
        <div class="text-2xl font-extrabold">
            <h1>{{$blog['title']}}</h1>
        </div>
        <div>
            <P>
                {{$blog['content']}}
            </P>
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="" alt="">
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="" alt="">
            </div>
        </div>
    </div>

@endsection
</body>
</html>
