@extends('app')

@section('content')
<div class="container">
 @include('post.left-column')
    <div class="right-column">
        @foreach($faqs as $faq)
            <article>
                <a href="/faqs/{!! $faq->slug !!}">
                    <h2>{!! $faq->title !!}</h2>
                </a>
                <a href="/faqs/{!! $faq->slug !!}">
                    <img src="/uploads/img/{!! $faq->images[0]->destinationPath !!}/{!! $faq->images[0]->slug !!}-{!! $faq->images[0]->size[1] !!}.jpg" alt="{!! $faq->images[0]->title !!}">
                </a>
                <p>
                    {!! $faq->excerpt !!}
                </p>
                <p>
                    published: {{ $faq->published_at  }}
                </p>
            </article>
        @endforeach
    </div>
</div>    
@stop