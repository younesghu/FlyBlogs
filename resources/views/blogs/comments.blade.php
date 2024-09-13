<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
    <div class="flex flex-col items-center w-full max-w-xl mx-auto">
        {{-- Create Comment Form --}}
        <div class="w-full">
            <form method="POST" action="/blogs/{{$blog->id}}" class="w-full bg-white rounded-lg p-4 shadow-md">
                @csrf
                <h2 class="text-gray-800 font-serif text-lg mb-2">Add a new comment</h2>
                <div class="mb-4">
                    <textarea class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full h-24 py-2 px-3 font-normal placeholder-gray-700 focus:outline-none"
                    name="content" placeholder="Type Your Comment" required></textarea>
                </div>
                <div class="flex justify-end">
                    <input type="submit" class="bg-white text-gray-700 font-serif py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value="Post Comment">
                </div>
            </form>
        </div>
        <div class="w-full">
            @foreach($comments as $comment)
                {{-- Show Comment Card --}}
                <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
                    <div class="relative flex gap-4">

                        {{-- Comment Owner Info: Image and Username --}}
                        <img src="{{ optional($comment->user)->user_img ? asset('storage/' . optional($comment->user)->user_img) : asset('images/img.webp') }}" class="relative rounded-lg -top-6 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy">
                        <div class="flex flex-col w-full">
                            <div class="flex flex-row justify-between">
                                <p class="relative font-serif text-xl truncate overflow-hidden">{{ optional($comment->user)->name}}</p>

                                {{-- Show Drop Down Menu for Specific users; Blog Owner & Comment Owner --}}
                                @auth
                                    @if (auth()->user()->id == $comment->user_id || auth()->user()->id == $blog->user_id)
                                        <div class="dropdown">
                                            <button class="dropbtn">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </button>
                                            <div class="dropdown-content rounded-md">

                                                {{-- Show Edit Button/Functionality only to Comment Owner --}}
                                                @if(auth()->user()->id == $comment->user_id)
                                                    <a href="#" onclick="event.preventDefault(); editComment({{ $comment->id }});" class="block px-4 py-2 text-sm font-serif rounded-t hover:bg-gray-100">Edit</a>
                                                @endif
                                                {{-- Show Delete Button to both Blog Owner & Comment Owner --}}
                                                <a href="#" onclick="event.preventDefault(); document.getElementById('deleteForm{{$comment->id}}').submit();" class="block px-4 py-2 rounded-b text-sm font-serif hover:bg-gray-100">Delete</a>
                                            </div>
                                        </div>

                                        {{-- Edit Comment Form which only shows up to Comment Owner --}}
                                        @if(auth()->user()->id == $comment->user_id)
                                            <div id="edit-comment-{{ $comment->id }}" class="w-full mt-8" style="display: none;">
                                                <form action="{{ route('comments.update', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST" class="bg-white rounded-lg">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-4">

                                                        <textarea name="content" rows="3" class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full h-32 py-2 px-3 font-normal placeholder-gray-700 focus:outline-none" placeholder="Edit Your Comment">{{ $comment->content }}</textarea>
                                                    </div>

                                                    <div class="flex justify-end">
                                                        <button type="button" onclick="cancelEdit({{ $comment->id }});" class="mr-2 bg-white text-gray-700 font-serif py-1 px-4 border border-gray-400 rounded-lg tracking-wide hover:bg-gray-100">Cancel</button>
                                                        <button type="submit" class="bg-gray-300 text-gray-700 font-serif py-1 px-4 border border-gray-400 rounded-lg tracking-wide hover:bg-gray-100">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif

                                        {{-- Delete Comment Form for both Blog Owner and Comment Owner --}}
                                        <form id="deleteForm{{$comment->id}}" action="{{ route('comments.destroy', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    @endif
                                @endauth
                            </div>
                            <p class="text-gray-400 font-serif text-sm">{{ $comment->created_at->format('d F Y, \a\t h:i A') }}</p>
                        </div>
                    </div>
                    <p class="-mt-4 text-gray-900 text-lg font-normal" id="comment-content-{{ $comment->id }}">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>

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
