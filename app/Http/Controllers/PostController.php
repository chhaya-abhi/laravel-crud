<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PostController extends Controller
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
        $posts = Post::all();
        return view('post-create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:300|string',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:1024',
            'body' => 'required|max:300|string'
        ]);

        if ($request->has('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();

            //Uploading Image to Server
            $request->image->move(public_path('uploads/image/'), $imageName);
            $data['image'] = $imageName;
        }

        Post::create($data);
        return back()->with('success', 'Post has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post-edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:300|string',
            'image' => 'sometimes|mimes:png,jpg,jpeg,webp|max:1024',
            'body' => 'required|max:300|string'
        ]);

        if ($request->has('image')) {

            // Check old image
            $destination = 'uploads/image/' . $post->image;

            // remove old image
            if (\Illuminate\Support\Facades\File::exists($destination)) {
                \Illuminate\Support\Facades\File::delete($destination);
            }

            // add new image
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();

            //Uploading Image to Server
            $request->image->move(public_path('uploads/image/'), $imageName);
            $data['image'] = $imageName;
        }

        $post->update($data);
        return redirect()->route('post.create')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check old image
        $destination = 'uploads/image/' . $post->image;

        // remove old image
        if (\Illuminate\Support\Facades\File::exists($destination)) {
            \Illuminate\Support\Facades\File::delete($destination);
        }

        $post->delete();
        return back()->with('success', 'Post has been Deleted!');
    }
}
