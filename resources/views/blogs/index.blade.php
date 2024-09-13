@extends('components.layout')

@section('content')
<h1 class="text-center text-gray-800 hover:text-gray-500 text-2xl italic mx-auto lg:w-3/4 font-medium">"Where Creativity Takes Flight—Share Your World with FlyBlogs."</h1>
<div class="mt-8 text-center">
    <span class="inline-block shadow-md bg-gray-100 rounded-full px-3 py-1 text-base font-semibold text-gray-500 mr-2 mb-2">
        <a href="/">All</a>
    </span>
    <span class="inline-block shadow-md bg-gray-100 rounded-full px-3 py-1 text-base font-semibold text-gray-500 mr-2 mb-2">
        <a href="/?category=technology">Technology</a>
    </span>
    <span class="inline-block shadow-md bg-gray-100 rounded-full px-3 py-1 text-base font-semibold text-gray-500 mr-2 mb-2">
        <a href="/?category=lifestyle">Lifestyle</a>
    </span>
    <span class="inline-block shadow-md bg-gray-100 rounded-full px-3 py-1 text-base font-semibold text-gray-500 mr-2 mb-2">
        <a href="/?category=travel">Travel</a>
    </span>
</div>
@include('partials._search')
    <div class="flex justify-center py-6">
        <div class="w-full max-w-6xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 gap-x-6 gap-y-6">
            @foreach ($blogs as $blog)
                @if (!$blog->is_scheduled || ($blog->is_scheduled && $blog->scheduled_at <= now()))
                    <a href="/blogs/{{$blog->id}}" class="flex flex-col items-center border border-gray-200 rounded shadow-md md:flex-row md:max-w-xl bg-gray-50 hover:bg-gray-100">
                        <img class="w-full h-full md:w-48 rounded-sm" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/blogimg.jpg')}}" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$blog->title}}</h5>

                            @php
                                $maxLines = 4;
                                $contentLines = explode("\n", wordwrap($blog->content, 50), $maxLines + 1);
                                array_pop($contentLines);
                                $limitedContent = implode("\n", $contentLines) . '...';
                            @endphp

                            <p class="mb-3 font-normal text-gray-500">{{$limitedContent}}</p>

                            <div class="flex items-center">
                                <img src="{{ $blog->user->user_img ? asset('storage/' . $blog->user->user_img) : asset('images/img.webp') }}" alt="User Image" class="w-8 h-8 rounded-full mr-3">
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none">By: <span class="text-transform: uppercase font-bold">{{$blog->user->name}}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <div class="flex justify-center">
        <div class="mt-2 w-full max-w-6xl">
            {{$blogs->links()}}
        </div>
    </div>


@endsection
