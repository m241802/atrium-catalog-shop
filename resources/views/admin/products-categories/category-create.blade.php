@extends('app2')

@section('content')
    <h1>Create Category</h1>
    {!! Form::open(array('route' => 'hc.category', 'files' => true)) !!}
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
        {!! Form::label('content') !!}
        {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        <input type="file" multiple="multiple" name="images[]" />
    </div>
    <h4>Галерея продукта</h4>
    <ul id="selected-images"></ul>
    <h4>Категории продукта</h4>
    <ul id="selected-cats"></ul>      
    <div ng-app="catsApp" ng-controller="catsListCtrl">       
        @include('admin.template.ang-categories')
        @include('admin.template.ang-images')
    </div>
@endsection