@extends('app')

@section('content')
<div class="container">
	 @include('post.left-column')
	<div class="right-column">
	   <h2>{!! $new[0]->title !!}</h2>
	   @if($new[0]->images[0])
	   @foreach($new[0]->images as $image)
	        <div class="product-img">
		        <a class="example_group" rel="example_group" href="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}">
		            <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[1] !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
		        </a>	        	
	        </div>	        
       @endforeach	
       @endif   
	   <p>
	       {!! $new[0]->content !!}
	   </p>
	   <p>
	       published: {!! $new[0]->published_at  !!}
	   </p>
   </div>
</div>   
@stop