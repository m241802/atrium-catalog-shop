@extends('app')

@section('content')
<div class="container">
    @include('post.left-column')
    <div class="right-column">
        @foreach($news as $new)
            <article>
                <a href="/news/{!! $new->slug !!}">
                    <h2>{!! $new->title !!}</h2>
                </a>
                <div class="news-img">
                    <a href="/news/{!! $new->slug !!}"class="news-loop-img">
                        <img src="/uploads/img/{!! $new->images[0]->destinationPath !!}/{!! $new->images[0]->slug !!}-{!! $new->images[0]->size[1] !!}.{!! $new->images[0]->type !!}" alt="{!! $new->images[0]->title !!}">
                    </a> 
                </div>               
                <div class="news-loop-exerpt">
                    {!! $new->excerpt !!}  
                    <p>
                        {!! $new->published_at  !!}
                    </p>                  
                </div>                
            </article>
        @endforeach
        <div class="pagination-wrap">
            {!! $news->render() !!}
        </div>      
    </div>
</div>    
@stop