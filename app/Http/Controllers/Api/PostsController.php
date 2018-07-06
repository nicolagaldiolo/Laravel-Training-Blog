<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Category;
use App\Events\PostWasUpdated;
use App\Http\Requests\PostRequest;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PostsController extends Controller
{

    function __construct(){
        $this->middleware('jwt.auth')->except('index', 'show');
    }

    public function index(){
        $posts = Post::with('user', 'category', 'tags')->latest();
        return $posts->get();
    }

    public function show(Post $post){

        $post->load('user', 'category', 'tags');
        return $post;
    }

    public function store(PostRequest $request){

        $post = auth()->user()->posts()->create( $request->validated());

        $post->tags()->sync($request->tags);

        return $post;
    }

    public function update(PostRequest $request, Post $post){

        $this->authorize('update', $post);

        $post->update( $request->validated());
        $post->tags()->sync($request->tags);

        //event(new PostWasUpdated($post));
        // scateno questo evento nel modello

        return $post;
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);

        // cancellare il post
        $post->delete();

        // dove reindirizzare
        return $post;
    }

}
