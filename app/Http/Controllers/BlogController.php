<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blogs.index', [
            'blogs' => Blog::latest()->filter(request(['search']))->SimplePaginate(6)
        ]);
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
            'content' => 'required'
        ]);

        if($request->hasFile('blog_img')){
            $data['blog_img'] = $request->file('blog_img')->store('blog_imgs', 'public');
        }

        $data['posted_at'] = Carbon::now();
        $data['user_id'] = auth()->id();

        Blog::create($data);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $comments = $blog->comments()->get();
        return view('blogs.show', [
            'blog' => $blog,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
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
    public function destroy(string $id)
    {
        //
    }
}
