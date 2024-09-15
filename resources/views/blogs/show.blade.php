@extends('components.layout')
@section('content')
<section class="max-w-7xl mx-auto my-6">
    <div class="text-center">

        {{-- Blog Title --}}
        <h1 class="text-5xl mx-auto lg:w-3/4 leading-normal font-serif font-bold">{{$blog->title}}</h1>

        {{-- Blog Categories --}}
        <div class="">
            <x-blog-categories :categoriesCsv="$blog->categories" />
        </div>

        {{-- Number of Likes --}}
        <div id="like-count-container justify-center items-center" class="">
            <i class="font-serif">
                Likes:
                <span id="like-count">{{ $blog->likes()->count() }}</span>
            </i>
            <i class="fa fa-heart text-red-500"></i>
        </div>

    </div>

    {{-- Split Screen Layout --}}
    <div class="flex flex-wrap lg:flex-nowrap justify-center items-stretch space-x-8">

        {{-- Blog Image - Left div --}}
        <div class="flex-shrink-0 w-full lg:w-1/3">
            <img class="m-auto w-full object-cover h-full max-w-xl rounded" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/blogimg.jpg')}}" alt="Blog Image">
        </div>

        {{-- Blog Content - Right div --}}
        <div class="w-full lg:w-2/3 flex flex-col justify-between">

            {{-- Blog Content --}}
            <p class="text-md text-gray-700 leading-loose font-serif flex-grow">{{$blog->content}}</p>

        </div>
    </div>

    {{-- Like Blog --}}
    <div class="flex items-center justify-center space-x-4 my-4">
        <button id="like-btn" class="text-xl text-red-500 font-serif hover:text-red-600"
            @auth
                data-liked="{{ auth()->check() && auth()->user()->hasLiked($blog) ? 'true' : 'false' }}"
                onclick="toggleLike({{ $blog->id }})"
            @else
                onclick="redirectToLogin()"
            @endauth>
            <i class="fa fa-heart"></i>
            <span id="like-btn-text">
                @auth
                    {{ auth()->check() && auth()->user()->hasLiked($blog) ? 'Unlike' : 'Like' }}
                @else
                    Like
                @endauth
            </span>
        </button>
    </div>

    {{-- Comments Section --}}
    <div>
        @include('blogs.comments', ['comments' => $comments, 'blog' => $blog])
    </div>

</section>
@endsection

<script>
    function toggleLike(blogId) {
        const likeBtn = document.getElementById('like-btn');
        const likeBtnText = document.getElementById('like-btn-text');
        const isLiked = likeBtn.getAttribute('data-liked') === 'true';

        fetch(`/blogs/${blogId}/${isLiked ? 'unlike' : 'like'}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            const likeCount = document.getElementById('like-count');
            likeCount.innerText = data.likes;

            const likeCountContainer = document.getElementById('like-count-container');

            likeBtn.setAttribute('data-liked', data.isLikedByUser ? 'true' : 'false');
            likeBtnText.innerText = data.isLikedByUser ? 'Unlike' : 'Like';
        })
        .catch(error => console.error('Error:', error));
    }

    function redirectToLogin() {
        window.location.href = '{{ route('login') }}';
    }
</script>
