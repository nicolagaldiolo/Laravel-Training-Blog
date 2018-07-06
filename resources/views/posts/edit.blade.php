@extends('layouts.app')

@section('content')
    <h4>Editing post: {{$post->title}}</h4>
    <form method="POST" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        {{--<div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{old('title', $post->title)}}">
        </div>

        <div class="form-group">
            <label for="cover">Cover Photo</label>
            <input type="file" class="form-control" name="cover">
        </div>

        <div class="form-group">
            <label for="category_id">Categories</label>
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($category->id == old('category_id', $post->category_id)) selected="" @endif>{{$category->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="preview">Preview</label>
            <textarea class="form-control" name="preview" rows="5">{{old('preview', $post->preview)}}</textarea>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" rows="5">{{old('body', $post->body)}}</textarea>
        </div>
        <div class="form-group">
            <label for="tags[]">Tags</label>
            <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}" @if(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray()))) selected="" @endif>{{$tag->name}}</option>
                @endforeach
            </select>
        </div>--}}
        @include('posts._form')
        <div class="form-group">
            <button type="submit" class="btn btn-warning btn-block">Publish post</button>
        </div>
    </form>

    <hr>


    @can('delete', $post)
        <form action="{{route('posts.destroy', $post)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger pull-right" onclick="return confirm('Are you Sure?')">Delete post</button>
        </form>
    @endcan()

@endsection
