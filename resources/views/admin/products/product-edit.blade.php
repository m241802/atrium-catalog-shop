@extends('app2')
<?php /*dd($post[0]);*/?>
@section('content')
    <h1>Update Product: "{!! $post[0]->title !!}"</h1>
    {!! link_to_action('ProductsController@create', $title='Новая новость', $parameters = array(), $attributes = array()) !!}
    {!! link_to_action('ProductsController@destroy', $title = 'Удалить новость', $parameters = array('id' => $post[0]->id), $attributes = array()) !!}
    {!! Form::open(array('route' => 'shop.update', 'files' => true)) !!}
    <div class="from-group">
        {!! Form::label('price') !!}
        {!! Form::text('price', $post[0]->price, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('unit_of_measure') !!}
        {!! Form::text('unit_of_measure', $post[0]->unit_of_measure, ['class'=>'form-control']) !!}
    </div>
     <div class="from-group">
        {!! Form::label('sku') !!}
        {!! Form::text('sku', $post[0]->sku, ['class'=>'form-control']) !!}
    </div>
    @include('admin._form_with_data')
    @include('admin.template.attributes-start')
    {!! Form::close() !!}
    <div ng-app="catsApp" ng-controller="catsListCtrl">
        @include('admin.template.ang-attributes')
        @include('admin.template.ang-categories')
        @include('admin.template.ang-images')
    </div>
@endsection