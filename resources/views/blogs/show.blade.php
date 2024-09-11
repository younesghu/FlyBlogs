@extends('components.layout')
@section('content')
<section class="">
    <div class="text-center">
            {{-- @auth
                @if(auth()->user()->id === $blog->user_id)
                <div class="flex justify-end space-x-4 mb-4">
                    <button onclick="window.location.href='/blogs/{{$blog->id}}/edit'" class="text-sm text-blue-500">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </button>
                    <form method="POST" action="/blogs/{{$blog->id}}" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm text-red-500">
                            <i class="fa-solid fa-trash mt-3"></i> Delete
                        </button>
                    </form>
                </div>
                @endif
            @endauth --}}


            {{-- Blog Owner div, image, Name, CreatedTime & ReadingTime --}}
            <div class="flex justify-center items-center">

                <!-- Blog Owner's Information -->
                <div class="flex items-center space-x-4 p-4 bg-gray-100 rounded-3xl mb-4">
                    <img src="{{ optional($blog->user)->user_img ? asset('storage/' . optional($blog->user)->user_img) : asset('images/img.webp') }}" alt="Profile Picture" class="w-12 h-12 rounded-full">
                    <div>
                        <div class="font-extrabold text-2xl">{{(($blog->user)->name)}}</div>
                        <div class="text-gray-500">{{$blog->created_at->format('M d, Y')}} &#183; {{$readingTime}} min read</div>
                    </div>
                </div>
            </div>

            {{-- Blog Categories --}}
            <div class="">
                <x-blog-categories :categoriesCsv="$blog->categories" />
            </div>

            {{-- Number of Likes --}}
            <div id="like-count-container justify-center items-center" class="">
                <i>
                    Likes:
                    <span id="like-count">{{ $blog->likes()->count() }}</span>
                </i>
                <i class="fa fa-heart text-red-500"></i>
            </div>

            {{-- Blog Title --}}
            <h1 class="text-5xl mx-auto lg:w-3/4 font-bold mb-4">{{$blog->title}}</h1>

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
            <p class="text-md text-gray-700 leading-relaxed flex-grow">{{$blog->content}}</p>

        </div>

    </div>

    {{-- Like Blog --}}
    <div class="flex items-center justify-center space-x-4 mb-4">
        <button id="like-btn" class="text-xl text-red-500 hover:text-red-600"
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
    <div class="w-1/2 mx-auto rounded-lg border border-gray-200 p-4">
        <div class="">
            @include('blogs.comments', ['comments' => $comments, 'blog' => $blog])
        </div>
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

    function confirmDelete() {
        return confirm('Are you sure you want to delete this blog?');
    }
</script>
