@extends('app2')

@section('content')
    <h1>Create slide</h1>
    {!! Form::open(array('route' =>'handler.slide.create')) !!}
    <div class="from-group admin-fixed-button">
        {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('slug') !!}
        {!! Form::text('slug', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('attributes') !!}
        {!! Form::text('attr', null, ['class'=>'form-control']) !!}
    </div>
    <div id="selected-images" class="ui-widget-content ui-state-default ui-droppable">
        <h4 class="ui-widget-header"><span class="ui-icon ui-icon-selected-images">Выбранные картинки</span>Выбранные картинки</h4>
    </div>
    {!! Form::close() !!}
    <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix ui-droppable">
        @foreach($images as $image)
            <li class="ui-widget-content ui-corner-tr">
                <h5 class="ui-widget-header">High Tatras 4</h5>
                <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[0] !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
                <input name="images[]" type="hidden" value="{!! $image->id !!}">
                <a href="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                <a href="link/to/selected-images/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-selected-images">Delete image</a>
            </li>
        @endforeach
    </ul>
@endsection
