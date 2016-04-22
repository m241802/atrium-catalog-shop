@extends('app')

@section('content')
<div class="container">
@include('post.left-column')
	<div class="right-column">
	   <h2>{!! $post[0]->title !!}</h2>
	   @if(isset($post[0]->images[0]))
	   <img src="/uploads/img/{!! $post[0]->images[0]->destinationPath !!}/{!! $post[0]->images[0]->slug !!}-{!! $post[0]->images[0]->size[1] !!}.jpg" alt="{!! $post[0]->images[0]->title !!}">
	   @endif
	   <p>
	       {!! $post[0]->content !!}
	   </p>
   </div> 
</div>    
@stop