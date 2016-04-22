@extends('app')
@section('content')
<div class="container">
@include('post.left-column')
    <div class="right-column">
        @if(!$products['message'])
        <div class="products-loop">
            @foreach($products as $product)
                <article class="product">       
                    @if(isset($product->images[0]))
                        <a class="link-to-product product-images-to-loop" href="/{!! $on_page !!}/{!! $product->slug !!}">
                           <img src="/uploads/img/{!! $product->images[0]->destinationPath !!}/{!! $product->images[0]->slug !!}-{!! $product->images[0]->size[1] !!}.{!! $product->images[0]->type !!}">
                        </a>
                    @endif
                    <div class="price">
                        @if(isset($product->price))
                            {!! $product->price !!} {!! $product->price_currency !!} / 
                            {!! $product->unit_of_measure !!}
                        @endif
                    </div> 
                    <a class="link-to-product" href="/{!! $on_page !!}/{!! $product->slug !!}">                  
                        <h5>{!! $product->title !!}</h5>
                    </a>
                </article>
            @endforeach
            <div class="pagination-wrap">
                {!! $products->render() !!}
            </div>                        
        </div>
        @else
        {!! $products['message'] !!} 
        @endif
    </div>
</div>    
@stop