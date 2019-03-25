<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller 
{ 
    public function store(Request $request) {
       $this->validate($request, [
            "title"     => "required|min:5",
            "content"   => "required|min:50"
       ]); 

       $post = Post::create([
            "title"     => $request->title,
            "user_id"   => Auth::user()->id,
            "content"   => $request->content,
       ]);

        return (new PostResource($post));
    } 

    public function destroy($id) {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            "data" => $post,
            "message" => "post deleted successfully!"
        ], 200);
    } 

    public function update(Request $request) {
        $this->validate($request, [
            "title"     => "required|min:5",
            "content"   => "required|min:50"
        ]);

        $post = Post::find($request->id);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return response()->json([
            "data" => $post,
            "message" => "post updated successfully!"
        ], 200);
    }

    public function index() {
        $posts = Post::paginate(15);
        return PostResource::collection($posts);
    }
}
