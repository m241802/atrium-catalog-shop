@extends('app2')
@section('content')
    <h2>Слайды</h2>
    @foreach($slides as $slide)
        <article class="slides">
            <a href="/admin/slider/{!! $slide->slug !!}">
                <h4>{!! $slide->slug !!}</h4>                
            </a>  
            <h4>{!! $slide->title !!}</h4>          
            <p>
                {!! $slide->attr !!}
            </p>
            <p>
            <ul class="gallery ui-helper-reset">
                @foreach($slide->images as $key => $image)
                    <li class="ui-widget-content ui-corner-tr">
                        <h5 class="ui-widget-header">{!! $image->slug !!}</h5>
                        <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
                        <a href="/uploads/img/{!! $image->slug !!}.{!! $image->type !!}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                    </li>
                @endforeach
            </ul>
            </p>
        </article>
    @endforeach
@stop