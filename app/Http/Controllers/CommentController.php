<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Blog $blog, Request $request)
    {
        $data = $request->validate([
            'content' => 'required|min:3|max:250',
        ]);
        $data['user_id'] = auth()->id();
        $data['blog_id'] = $blog->id;
        // dd($data);
        Comment::create($data);

        return redirect("/blogs/{$blog->id}");

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog, Comment $comment)
    {
        $data = $request->validate([
            'content' => 'required|min:3|max:250',
        ]);

        $commentId = Comment::findOrFail($comment->id);
        $commentId->update($data);

        return redirect("/blogs/{$blog->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Comment $comment)
    {
        $comment->delete();
        return redirect("/blogs/{$blog->id}");
    }
}
