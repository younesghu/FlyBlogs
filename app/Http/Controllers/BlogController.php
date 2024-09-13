<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Notifications\BlogLiked;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\TwitterController;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = now();

        // Fetch blogs that are either immediate or scheduled and in the past
        $blogs = Blog::where(function ($query) use ($now) {
            $query->where('is_scheduled', false)
                ->orWhere(function ($query) use ($now) {
                    $query->where('is_scheduled', true)
                            ->where('scheduled_at', '<=', $now);
                });
        })
        ->filter(request(['category', 'search'])) // Apply any filters
        ->orderBy('scheduled_at', 'desc') // Order by scheduled_at, so scheduled posts are prioritized
        ->orderBy('posted_at', 'desc') // Order by posted_at to ensure immediate posts appear correctly
        ->simplePaginate(6); // Paginate results

        return view('blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store title, categories, and content in $data
        $data = $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'content' => 'required',
        ]);

        // Check if a blog image is uploaded and store it in the 'public/blog_imgs' directory
        if ($request->hasFile('blog_img')) {
                $data['blog_img'] = $request->file('blog_img')->store('blog_imgs', 'public');
            }

        // Check if blog is scheduled
        if ($request->has('schedule_post')) {
            // Parse and set the scheduled date and time
            $scheduledDateTime = Carbon::parse($request->scheduled_at);
            $data['scheduled_at'] = $scheduledDateTime;
            $data['is_scheduled'] = true;
            $data['posted_at'] = null;
        } else {
            // Set posted_at to the current time for immediate posts
            $data['is_scheduled'] = false;
            $data['posted_at'] = now();
        }

        // Determine if the blog should be shared on Twitter
        $data['share_in_twitter'] = $request->has('share_in_twitter');
        $data['user_id'] = auth()->id();

        // Create a new blog entry in the database
        $blog = Blog::create($data);

        // If sharing on Twitter is enabled, and the user has valid Twitter credentials, post the blog to Twitter
        if ($data['share_in_twitter'] && Auth::user() && Auth::user()->twitter_token && Auth::user()->twitter_token_secret) {
                try {
                    // Use dependency injection to get an instance of TwitterController
                    $twitterController = app(TwitterController::class);
                    $twitterController->postBlogAsTweet($blog, Auth::id());
                } catch (\Exception $e) {
                    // Log an error if posting to Twitter fails
                    Log::error('Error posting blog to Twitter', ['error' => $e->getMessage()]);
                }
            }

            // Redirect to the homepage after storing the blog
            return redirect('/');
    }

    public function like(Blog $blog)
    {
        $user = auth()->user();

        if (!$user->hasLiked($blog)) {
            $user->like($blog);
            $blog->user->notify(new BlogLiked($blog, $user));

        }

        return response()->json([
            'likes' => $blog->likes()->count(),
            'isLikedByUser' => $user->hasLiked($blog),
        ]);
    }

    public function unlike(Blog $blog)
    {
        $user = auth()->user();

        if ($user->hasLiked($blog)) {
            $user->unlike($blog);
        }

        return response()->json([
            'likes' => $blog->likes()->count(),
            'isLikedByUser' => $user->hasLiked($blog),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $comments = $blog->comments()->orderBy('created_at', 'desc')->get();
        $wordCount = str_word_count(strip_tags($blog->content));
        $readingTime = ceil($wordCount / 180); // Assuming 180 words per minute

        return view('blogs.show', [
            'blog' => $blog,
            'comments' => $comments,
            'readingTime' => $readingTime
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        return view('blogs.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        if($blog->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $data = $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'content' => 'required'
        ]);
        if($request->hasFile('blog_img')){
            $data['blog_img'] = $request->file('blog_img')->store('blog_imgs', 'public');
        }
        $blog->update($data);

        return redirect("/blogs/{$blog->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $blog->delete();
        return redirect('/');
    }

    public function manage(){
        try {
            $blogs = auth()->user()->blogs()->get();
            return view('blogs.manage', ['blogs' => $blogs]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error fetching user blogs.');
        }
    }

}
