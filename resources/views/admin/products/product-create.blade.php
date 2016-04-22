@extends('app2')

@section('content')
    <h1>Create product</h1>
    {!! Form::open(array('route' => 'shop.store', 'files' => true)) !!}
    <div class="from-group">
        {!! Form::label('price') !!}
        {!! Form::text('price', NULL, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('unit_of_measure') !!}
        {!! Form::text('unit_of_measure', NULL, ['class'=>'form-control']) !!}
    </div>
     <div class="from-group">
        {!! Form::label('sku') !!}
        {!! Form::text('sku', NULL, ['class'=>'form-control']) !!}
    </div>
    @include('admin._form')    
    {!! Form::close() !!}
    <div ng-app="catsApp" ng-controller="catsListCtrl">
        @include('admin.template.ang-attributes')
        @include('admin.template.ang-categories')
        @include('admin.template.ang-images')
    </div>
@endsection