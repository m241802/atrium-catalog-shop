@extends('app2')

@section('content')
    <h1>Update New: "{!! $post[0]->title !!}"</h1>
    {!! Form::open(array('route' => 'slide.update', 'files' => true)) !!}
    <div class="from-group admin-fixed-button">
        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::hidden('id', $post[0]->id, ['id'=>'id-element']) !!}
    <div class="from-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', $post[0]->title, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('attributes') !!}
        {!! Form::text('attr', $post[0]->attr, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        <input type="file" multiple="multiple" name="images[]" />
    </div>
    @include('admin.template.images-start')
    {!! Form::close() !!}
    <div ng-app="catsApp" ng-controller="catsListCtrl">
        @include('admin.template.ang-images')
    </div>    
@endsection