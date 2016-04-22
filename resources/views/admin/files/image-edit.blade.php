@extends('app2')

    @section('content')
    <h1>Картинка: "{!! $post[0]->title !!}"</h1>
    {!! Form::open(array('route'=>'images.update')) !!}
    {!! Form::hidden('id', $post[0]->id) !!}
    <div class="from-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', $post[0]->title, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        <img width="300px" src="/uploads/img/{!! $post[0]->destinationPath !!}/{!! $post[0]->slug !!}.{!! $image->type !!}" alt="{!! $post[0]->title !!}">
    </div>
    <div class="from-group">
        {!! Form::label('excerpt') !!}
        {!! Form::textarea('excerpt', $post[0]->excerpt, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('Сохранена') !!}: "{!! $post[0]->created_at !!}"
    </div>
    <div class="from-group admin-fixed-button">
        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    @endsection