<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('updated_at', 'DESC')->get();
        return view('blog.index')->with('posts', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "title" => 'required',
            "description" => 'required',
            "image" => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' .$request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        Post::create([
            'titile' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/blog')->with('message', 'Your post has been added');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('blog.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('blog.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validate = $request->validate([
            "title" => 'required',
            "description" => 'required',
        ]);

        Post::where('slug', $slug)->update([
            'titile' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/blog')->with('message', 'Your post has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
