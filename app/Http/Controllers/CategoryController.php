<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('manutenzione')->only('show');
    }

    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->paginate(15);
        // $posts = $category->posts->load('user', 'category', 'tags');

        return view('posts.index', compact('posts'));
    }
}
