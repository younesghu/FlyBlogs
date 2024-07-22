@extends('components.layout')
@section('content')
<section class="py-4">
        {{-- @auth
            @if(auth()->user()->id === $blog->user_id)
                <a href="/blogs/{{$blog->id}}/edit">
                    <i class="fa-solid fa-pencil mb-3" ></i> Edit
                </a>
                <form method="POST" action="/blogs/{{$blog->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash mt-3"></i> Delete</button>
                </form>
            @endif
        @endauth --}}
            <div class="text-center">
                {{-- Blog Categories --}}
                <div class="mb-4">
                    <x-blog-categories :categoriesCsv="$blog->categories" />
                </div>
                {{-- Blog Title --}}
                <h1 class="text-5xl mx-auto lg:w-3/4 font-bold mb-2">{{$blog->title}}</h1>
                {{-- Blog Owner div; image, Name, CreatedTime & ReadingTime --}}
                <div class="flex justify-center items-center space-x-4 p-4 rounded-lg">
                    <img src="{{ optional($blog->user)->user_img ? asset('storage/' . optional($blog->user)->user_img) : asset('images/img.webp') }}" alt="Profile Picture" class="w-12 h-12 rounded-full">
                    <div>
                        <div class="font-extrabold text-2xl">{{(($blog->user)->name)}}</div>
                        <div class="text-gray-500">{{$blog->created_at->format('M d, Y')}} &#183; {{$readingTime}} min read</div>
                    </div>
                </div>
                {{-- Blog Image --}}
                <img class="rounded-lg mx-auto my-auto w-full max-w-3xl h-full" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/blogimg.jpg')}}" alt="">
                <p class="my-8 text-xl text-gray-700 w-3/4 mx-auto text-left leading-relaxed">{{$blog->content}}</p>

                {{-- Like Blog --}}
                <div class="flex items-center justify-center space-x-4">
                    <div id="like-count-container" class="flex items-center space-x-2">
                        <i class="fa fa-heart text-red-500"></i>
                        <span id="like-count">{{ $blog->likes()->count() }}</span>
                    </div>
                    <button id="like-btn" class="text-xl text-red-500"
                        @auth
                            data-liked="{{ auth()->user()->hasLiked($blog) ? 'true' : 'false' }}"
                            onclick="toggleLike({{ $blog->id }})"
                        @else
                            onclick="redirectToLogin()"
                        @endauth>
                        Like
                    </button>
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="">
                <div class="w-3/4 mx-auto rounded-lg border border-gray-200 p-4">
                    @include('blogs.comments', ['comments' => $comments, 'blog' => $blog])
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    function toggleLike(blogId) {
        const likeBtn = document.getElementById('like-btn');
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
            if (data.likes > 0) {
                likeCountContainer.style.display = 'flex';
            } else {
                likeCountContainer.style.display = 'none';
            }

            likeBtn.setAttribute('data-liked', data.isLikedByUser ? 'true' : 'false');
        })
        .catch(error => console.error('Error:', error));
    }
    function redirectToLogin() {
        window.location.href = '{{ route('login') }}';
    }
</script>
