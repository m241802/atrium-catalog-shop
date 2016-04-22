@extends('app')

@section('content')
<div class="container">
@include('post.left-column')
    <div class="right-column">
        <h1>{!! $post[0]->title !!}</h1>
        <p>
            {!! $post[0]->content !!}
        </p>
        <div class="product-slider">
            <div class="slider-for">
                @if(isset($post[0]->images[0]))
                @foreach($post[0]->images as $image)
                    <div class="product-img">
                        <a class="example_group product-image" rel="example_group" href="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}">
                            <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[1] !!}.{!! $image->type !!}">
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="product-gallery">
                @if(isset($post[0]->images[1]))
                @foreach($post[0]->images as $image)
                    <div class="product-img">
                        <a class="example_group item-gallery" rel="example_group" href="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}">
                            <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[0] !!}.{!! $image->type !!}">
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="product-attributes">
            <h4>Свойства товара</h4>
            <div>            
                @foreach($post[0]->attr as $attributes)
                   {!! $attributes->attr_tax !!} -
                   {!! $attributes->title !!}
                    <br>
                @endforeach           
            </div>
            <div class="price-wrapp">
                @if(isset($post[0]->price))
                    Цена - 
                    <span class="price">{!! $post[0]->price !!}</span> {!! $post[0]->price_currency !!} / 
                    {!! $post[0]->unit_of_measure !!}

                @endif
            </div>            
        </div>
        
    </div>
</div>    
@stop