@extends('layouts.app')

@section('content')
    <h3>@lang('messages.heading')</h3> <!-- Modo uno -->
    {{-- <h3>{{__('messages.heading')}}</h3> <!-- Modo due --> --}}
    @foreach($posts as $post)
        @include('posts._post', ['showFull' => false])
    @endforeach

    {{$posts->links()}}
@endsection
