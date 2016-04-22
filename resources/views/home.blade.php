@extends('app')

@section('content')
<div class="slider-wrap">
    <div class="slider">
        @foreach($slides as $slide)            
            <div class="slide {!! $slide->slug !!}">
                <img width="700" height="440px" class="slide-image" src="/uploads/img/{!! $slide->images[0]->destinationPath !!}/{!! $slide->images[0]->slug !!}.{!! $slide->images[0]->type !!}">
                <div class="slide-text" style="{!! $slide->attr !!}">{!! $slide->title !!}</div>
            </div>
        @endforeach
    </div>
</div> 
<div class="container">
    @include('post.left-column')
    <div class="right-column">
        <div class="products-loop">       
            @foreach($products as $product)
                <article class="product">       
                    @if(isset($product->images[0]))
                        <a class="link-to-product product-images-to-loop" href="/shop/category/{!! $product->slug !!}">
                           <img src="/uploads/img/{!! $product->images[0]->destinationPath !!}/{!! $product->images[0]->slug !!}-{!! $product->images[0]->size[1] !!}.{!! $product->images[0]->type !!}">
                        </a>
                    @endif
                    <a class="link-to-product" href="/shop/category/{!! $product->slug !!}">
                     <h5>{!! $product->title !!}</h5>
                   </a>
                </article>
            @endforeach            
        </div>
        <div class="news-home"> 
        <a class="link-to-product" href="/news/">
            <h3>Новости</h3>
        </a>      
            @foreach($news as $new)

                <article class="product">       
                    @if(isset($new->images[0]))
                        <a class="link-to-product product-images-to-loop" href="/news/{!! $new->slug !!}">
                           <img src="/uploads/img/{!! $new->images[0]->destinationPath !!}/{!! $new->images[0]->slug !!}-{!! $new->images[0]->size[1] !!}.{!! $new->images[0]->type !!}">
                        </a>
                        <div class="new-date">{!! $new->published_at  !!}</div>
                    @endif
                    <a class="link-to-product" href="/news/{!! $new->slug !!}">
                     <h5>{!! $new->title !!}</h5>
                   </a>
                </article>
            @endforeach            
        </div>
    </div>
</div>    
@stop