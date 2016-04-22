@extends('app')

@section('content')
<div class="container">
    @include('post.left-column')
    <div class="right-column">
        @foreach($products as $product)
            <article>trhjtyjuykm
                <h2>{!! $product->title !!}</h2>
                    <p>
                        {!! $product->excerpt !!}
                    </p>
                    <p>
                        published: {!! $product->published_at  !!}
                    </p>
            </article>
        @endforeach
    </div>
</div>    
@stop