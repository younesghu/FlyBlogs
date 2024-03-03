@extends('components.layout')

@section('content')
@include('partials._search')

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            @if (!$blog->is_scheduled || ($blog->is_scheduled && $blog->scheduled_at <= now()))
                <a href="/blogs/{{$blog->id}}" class="flex flex-col items-center border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-900 dark:border-gray-700 bg-custom-color">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$blog->title}}</h5>

                        @php
                            $maxLines = 4;
                            $contentLines = explode("\n", wordwrap($blog->content, 50), $maxLines + 1);
                            array_pop($contentLines);
                            $limitedContent = implode("\n", $contentLines) . '...';
                        @endphp

                        <p class="mb-3 font-normal text-gray-400 dark:text-gray-400">{{$limitedContent}}</p>

                        <div class="flex items-center">
                            <img src="{{ $blog->user->user_img ? asset('storage/' . $blog->user->user_img) : asset('images/profilepic.jpg') }}" alt="User Image" class="w-8 h-8 rounded-full mr-3">
                            <div class="text-sm">
                                <p class="text-white leading-none">By: {{$blog->user->name}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    <div class="mt-2 p-2">
        {{$blogs->links()}}
    </div>

@endsection
