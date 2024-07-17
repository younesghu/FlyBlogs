<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
/>
@foreach($comments as $comment)
    <div class="flex items-start mb-4">
        <img src="{{ optional($comment->user)->user_img ? asset('storage/' . optional($comment->user)->user_img) : asset('images/profilepic.jpg') }}" alt="Profile" class="w-8 h-8 rounded-full mr-3">
        <div class="flex-1">
            <div class="flex items-center justify-between mb-2">
                <h5 class="text-gray-800 font-semibold">{{ optional($comment->user)->name ?? 'Anonymous' }}</h5>
                <span class="text-gray-500 text-xs">
                    {{$comment->created_at->diffForHumans()}}
                </span>
                @auth
                    <div class="dropdown">
                        <button class="dropbtn">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="/blogs/{{$blog->id}}/comments/{{$comment->id}}/edit" class="block px-4 py-2 hover:bg-gray-200">Edit</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('deleteForm{{$comment->id}}').submit();" class="block px-4 py-2 hover:bg-gray-200">Delete</a>
                        </div>
                    </div>

                    <form id="deleteForm{{$comment->id}}" action="/blogs/{{$blog->id}}/comments/{{$comment->id}}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endauth
            </div>
            <p class="text-gray-700">{{$comment->content}}</p>
        </div>
    </div>
@endforeach

<form method="POST" action="/blogs/{{$blog->id}}">
    @csrf
    <div class="flex items-center">
        @auth
            <img src="{{ auth()->user()->user_img ? asset('storage/' . auth()->user()->user_img) : asset('images/profilepic.jpg') }}" alt="Profile" class="w-8 h-8 rounded-full mr-3">
        @else
            <img src="{{ asset('images/profilepic.jpg') }}" alt="Default" class="w-8 h-8 rounded-full mr-3">
        @endauth
        <div class="flex-1">
            <textarea name="content" class="w-full bg-gray-100 rounded-lg p-2 focus:outline-none" rows="3" placeholder="Add a comment..."></textarea>
            <div class="flex items-center justify-between mt-2">
                <button type="submit" class="text-sm text-gray-900 font-bold">Post</button>
            </div>
        </div>
    </div>
</form>
