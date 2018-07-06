<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\PostWasUpdated;
use App\Http\Requests\PostRequest;
use App\Tag;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    public function __construct(){
        //$this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy');
        $this->middleware('auth')->except('index', 'show');
    }

    public function index(){
        // faccio un join altrimenti mi fa un marea di records
        //$posts = Post::with('user', 'category', 'tags')->latest()->get();
        //$posts = Post::with('user', 'category', 'tags')->latest()->paginate(); // record paginato
        //$posts = Post::with('user', 'category', 'tags')->latest()->Simplepaginate(); // record con paginazione paginato
        $posts = Post::with('user', 'category', 'tags')->latest();

        //return request()->header();

        if(request()->wantsJson() || request()->expectsJson()){
            return $posts->get();
        }

        $posts = $posts->paginate(15);

        return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post){

        //dd(config('filesystems.disks.public'));

        $post->load('user', 'category', 'tags');

        return view('posts.show', compact('post'));
    }

    public function create(){

        $categories = Category::all();
        $tags = Tag::all();

        $post = new Post;

        return view('posts.create', compact('post', 'categories', 'tags'));
    }

    public function store(PostRequest $request){

        // modi per recuperare info sull'utente
        //return Auth::user()->id;
        //return auth()->user()->id;
        //return auth()->id();

        //return request()->all();
        //return $request->all();
        //return $request->get('preview');
        //return $request->preview;

        // METODO 1
        /*$post = new Post;
        $post->title = $request->title;
        $post->preview = $request->preview;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        $post->save();
        */

        // METODO 2
        /*$post = Post::create([
            'title' => $request->title,
            'preview' => $request->preview,
            'category_id' => $request->category_id,
            'body' => $request->body
        ]);*/

        // METODO 3
        //$post = auth()->user()->posts()->create( $request->only('title', 'preview', 'category_id', 'body'));

        $post = auth()->user()->posts()->create( $request->validated());
        // dammi il post appena creato, vai alla relazione tags e salva anche i tags nella tabella pivot


        // non serve fare questo perchè ho aggiunto il file alla validazione e quando faccio la creazione del post
        // (dato che un mutators nel modello) appena faccio il salvataggio implicitamente viene fatto lo store del file.
        //$file = $request->file('cover');
        //$post->cover = $file->store('covers');
        //$post->save();

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.show', $post)
            ->with('type', 'success')
            ->with('status', 'Post was created');
    }

    public function edit(Post $post){

        $this->authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();

        $post->load('tags');

        return view('posts.edit', compact('post', 'categories', 'tags'));
        //$post->load('user', 'category', 'tags');

        //return view('posts.show', compact('post'));
    }

    public function update(PostRequest $request, Post $post){

        $this->authorize('update', $post);

        $post->update( $request->validated());
        $post->tags()->sync($request->tags);

        //event(new PostWasUpdated($post));
        // scateno questo evento nel modello

        return redirect()->route('posts.show', $post)
            ->with('type', 'warning')
            ->with('status', 'Post was updated');
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);


        // NON FACCIO QUESTO NEL CONTROLLER PERCHè LO FACCIO FARE AUTOMATICAMENTE AL MODELLO, VEDI METODO BOOT
        // rimuovere associazioni tags
        //$post->tags()->sync([]); // se gli passo un array vuoto spiano via tutto
        //unlink(public_path($post->cover)); // elimino il file

        // cancellare il post
        $post->delete();

        // dove reindirizzare
        return redirect('/');
    }

}
