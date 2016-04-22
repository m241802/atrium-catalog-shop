@extends('app2')

@section('content')
    <h1>Create Faq</h1>
    {!! Form::open(array('route' => 'faq.store', 'files' => true)) !!}
    @include('admin._form')
    {!! Form::close() !!}
    <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix ui-droppable">
        @foreach($images as $image)
            <li class="ui-widget-content ui-corner-tr">
                <h5 class="ui-widget-header">{!! $image->slug !!}</h5>

                <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[0] !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
                <input name="img-{!! $image->id !!}" type="hidden" value="{!! $image->id !!}">
                <a href="/uploads/img/{!! $image->slug !!}.{!! $image->type !!}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                <a href="link/to/selected-images/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-selected-images">Delete image</a>
            </li>
        @endforeach
    </ul>
@endsection
