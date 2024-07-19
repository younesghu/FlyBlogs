@extends('components.layout')

@section('content')
@include('partials._search')
    <div class="flex justify-center px-6 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-x-6 gap-y-6 mx-6">
            @foreach ($blogs as $blog)
                @if (!$blog->is_scheduled || ($blog->is_scheduled && $blog->scheduled_at <= now()))
                    <a href="/blogs/{{$blog->id}}" class="flex flex-col items-center border border-gray-200 rounded shadow md:flex-row md:max-w-xl bg-gray-50 hover:bg-gray-100">
                        <img class="w-full h-96 md:h-auto md:w-48 rounded-sm" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="">
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
                                <img src="{{ $blog->user->user_img ? asset('storage/' . $blog->user->user_img) : asset('images/profilepic.jpg') }}" alt="User Image" class="w-8 h-8 rounded-full mr-3">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900 leading-none">By: {{$blog->user->name}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="mt-2 p-2">
        {{$blogs->links()}}
    </div>

@include('partials._footer')
@endsection
