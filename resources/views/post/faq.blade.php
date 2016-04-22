@extends('app')

@section('content')
<div class="container">
    @include('post.left-column')
    <div class="right-column">
	   <h2>{!! $post[0]->title !!}</h2>
	   <img src="/uploads/img/{!! $post[0]->images[0]->destinationPath !!}/{!! $post[0]->images[0]->slug !!}-{!! $post[0]->images[0]->size[1] !!}.jpg" alt="{!! $post[0]->images[0]->title !!}">
	   <p>
	       {!! $post[0]->content !!}
	   </p>
	   <p>
	       published: {{ $post[0]->published_at  }}
	   </p>
   </div>
</div>   
@stop