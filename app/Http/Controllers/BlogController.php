<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('is_scheduled', false) // Only fetch posts that are not scheduled
                  ->orWhere(function($query) {
                      $query->where('is_scheduled', true)
                            ->where('scheduled_at', '<=', now()); // Fetch scheduled posts if scheduled_at is in the past
                  })
                  ->get();
                  return view('blogs.index', ['blogs' => Blog::latest() ->where('is_scheduled', false)
                                                                        ->filter(request(['category','search']))
                                                                        ->Paginate(6)]);
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
        $data = $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'content' => 'required',
        ]);

        if($request->hasFile('blog_img')){
            $data['blog_img'] = $request->file('blog_img')->store('blog_imgs', 'public');
        }
        if ($request->has('schedule_post')) {
            // User has opted to schedule the post
            $scheduledDateTime = Carbon::parse($request->scheduled_at);

            // Store the scheduled date and time in the database
            $data['scheduled_at'] = $scheduledDateTime;

            // Set the post status as scheduled and switch to true
            $data['is_scheduled'] = true;
        } else {
            // Set the post status as published and switch to false
            $data['is_scheduled'] = false;
            // User wants to publish the post immediately
            $data['posted_at'] = now();
        }

        // Save the post data to the database
        $data['user_id'] = auth()->id();
        Blog::create($data);

        return redirect('/');
        // Save the blog post
        // $blog = DB::transaction(function () use ($data) {
        //     return Blog::create($data);
        // });

    }
    public function like(Blog $blog)
    {
        $user = auth()->user();

        if (!$user->hasLiked($blog)) {
            $user->like($blog);
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
