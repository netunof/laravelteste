<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::latest()->paginate(10);

        return view('posts.index',compact('data'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'resumo' => 'required',
            'corpo' => 'required',
        ]);

        $post = Post::create($request->all());

        if(!is_null($post)) {
            return response()->json(["status" => "success", "message" => "Success! post created.", "data" => $post]);
        } else {
            return response()->json(["status" => "failed", "message" => "Alert! post not created"]);
        }
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titulo' => 'required',
            'resumo' => 'required',
            'corpo' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
                        ->with('success','Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success','Post deleted successfully');
    }
}

