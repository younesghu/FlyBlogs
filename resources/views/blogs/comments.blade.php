<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
    <form method="POST" action="/blogs/{{$blog->id}}">
        @csrf
        <div class="flex items-center">
            @auth
                <img src="{{ auth()->user()->user_img ? asset('storage/' . auth()->user()->user_img) : asset('images/img.webp') }}" alt="Profile" class="w-8 h-8 rounded-full mr-3">
            @else
                <img src="{{ asset('images/img.webp') }}" alt="Default" class="w-8 h-8 rounded-full mr-3">
            @endauth
            <div class="flex-1">
                <textarea name="content" class="w-full bg-gray-100 rounded p-2 text resize-none focus:outline-none" rows="3" placeholder="Add a comment..."></textarea>
                <div class="flex items-center justify-between my-4">
                    <button type="submit" class="text-base text-gray-600 font-bold">Post</button>
                </div>
            </div>
        </div>
    </form>

    @foreach($comments as $comment)
        <div class="flex items-start">
            <img src="{{ optional($comment->user)->user_img ? asset('storage/' . optional($comment->user)->user_img) : asset('images/img.webp') }}" alt="Profile" class="w-8 h-8 rounded-full mr-3">
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <h5 class="text-gray-800 font-semibold">{{ optional($comment->user)->name ?? 'Anonymous' }}</h5>
                    <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                    @auth
                        @if (auth()->user()->id == $comment->user_id || auth()->user()->id == $blog->user_id)
                        <div class="dropdown">
                            <button class="dropbtn">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-content">
                                @if(auth()->user()->id == $comment->user_id)
                                    <a href="#" onclick="event.preventDefault(); editComment({{ $comment->id }});" class="block px-4 py-2 hover:bg-gray-200">Edit</a>
                                @endif
                                <a href="#" onclick="event.preventDefault(); document.getElementById('deleteForm{{$comment->id}}').submit();" class="block px-4 py-2 hover:bg-gray-200">Delete</a>
                            </div>
                        </div>
                        @if(auth()->user()->id == $comment->user_id)
                            <div id="edit-comment-{{ $comment->id }}" class="w-3/4 mt-4" style="display: none;">
                                <form action="{{ route('comments.update', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST" class="bg-gray-100 p-4 rounded">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="content" rows="3" class="w-full p-2 bg-white border border-gray-100 focus:outline-none" placeholder="">{{ $comment->content }}</textarea>
                                    <div class="flex justify-end mt-2">
                                        <button type="button" onclick="cancelEdit({{ $comment->id }});" class="mr-2 px-4 py-2 bg-gray-50 text-xs text-gray-600 focus:outline-none">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-gray-300 text-xs text-gray-900 focus:outline-none">Update </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <form id="deleteForm{{$comment->id}}" action="{{ route('comments.destroy', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-700" id="comment-content-{{ $comment->id }}">{{ $comment->content }}</p>
            </div>
        </div>
    @endforeach
<script>
    function editComment(commentId) {
        document.getElementById('comment-content-' + commentId).style.display = 'none';
        document.getElementById('edit-comment-' + commentId).style.display = 'block';
    }

    function cancelEdit(commentId) {
        document.getElementById('comment-content-' + commentId).style.display = 'block';
        document.getElementById('edit-comment-' + commentId).style.display = 'none';
    }
</script>
</body>
