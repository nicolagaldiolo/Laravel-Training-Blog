<h3>{{$post->title}}</h3>
<div class="row">
    <div class="col-md-12">

        <img src="{{asset($post->cover)}}" style="width:100%" />

        <div class="card">
            <div class="card-header">
                <h4><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h4>
                <small>Posted by {{$post->user->name}}</small>
                <small>on {{$post->category->name}}</small>
                <small>{{$post->created_at->diffForHumans()}}</small>
                @can('update', $post)
                    <small class="pull-right">
                        <a href="{{route('posts.edit', $post->id)}}">Edit Post</a>
                    </small>
                @endcan
            </div>
            <div class="card-body">
                <p>{{$post->preview}}</p>
                @if(isset($showFull))
                    <p>{{$post->body}}</p>
                @endif

            </div>
            <div class="card-footer">
                {{join(', ', $post->tags->pluck('name')->toArray()) }}
            </div>
        </div>
    </div>
</div>