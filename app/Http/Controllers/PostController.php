<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::filter()->paginate();
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($request->only(['title', 'content']));

        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::findOrFail($id);

        $post->update($request->only(['title', 'content', 'user_id']));

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post = $post->delete();

        return response()->json(['message' => 'Remove Succesfully']);
    }
}
