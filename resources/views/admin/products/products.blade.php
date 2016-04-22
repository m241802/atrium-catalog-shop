@extends('app2')

@section('content')
    @foreach($products as $product)
        <article>
            <a href="/admin/shop/{!! $product->slug !!}">
                <h2>{!! $product->title !!}</h2>
            </a>
            <p>
                {!! $product->excerpt !!}
            </p>
            <p>
                created: {!! $product->created_at  !!}
            </p>
            <p>
                updated: {!! $product->updated_at  !!}
            </p>
            <p>
                @if(isset($product->images[0]))
                @foreach($product->images as $image)
                    <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[0] !!}.{!! $image->type !!}">
                @endforeach
                @endif
            </p>
        </article>
    @endforeach
@stop