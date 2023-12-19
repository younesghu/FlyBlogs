@extends('components.layout')

@section('content')
@include('partials._search')
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            <a href="/blogs/{{$blog->id}}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="images/nature-pic.jpg" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog->title}}</h5>
                    <p class="mb-3 font-normal text-gray-400 dark:text-gray-400">{{$blog->content}}</p>
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full mr-4" src="images/profilepic.jpg" alt="Avatar of Jonathan Reinink">
                        <div class="text-sm">
                          <p class="text-gray-900 leading-none">By: {{$blog->user->name}}</p>
                          {{-- <p class="text-gray-600">{{$blog['posted_at']}}</p> --}}
                        </div>
                    </div>
                </div>
            </a>
                    {{-- <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/images/nature-pic.jpg')" title="Woman holding a mug">
                </div>
                <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                  <div class="mb-8">
                    <div class="text-gray-900 font-bold text-xl mb-2">{{$blog['title']}}</div>
                    <p class="text-gray-700 text-base">{{$blog['content']}}</p>
                  </div>
                  <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full mr-4" src="images/profilepic.jpg" alt="Avatar of Jonathan Reinink">
                    <div class="text-sm">
                      <p class="text-gray-900 leading-none">{{$blog->user->name}}</p>
                      <p class="text-gray-600">{{$blog['posted_at']}}</p>
                    </div>
                  </div>
                </div> --}}
        @endforeach
    </div>
    <div class="mt-6 p-4">
        {{$blogs->links()}}
    </div>
@endsection
