@extends('app2')

@section('content')
    <h1>Update Post: "{!! $post[0]->title !!}"</h1>
    {!! link_to_action('PostController@create', $title='Новая новость', $parameters = array(), $attributes = array()) !!}
    {!! link_to_action('PostController@destroy', $title = 'Удалить новость', $parameters = array('id' => $post[0]->id), $attributes = array()) !!}
    {!! Form::open(array('route' => 'post.update', 'files' => true)) !!}
    @include('admin._form_with_data')
    {!! Form::close() !!}
    <div ng-app="catsApp" ng-controller="catsListCtrl">       
        @include('admin.template.ang-images')
    </div>
@endsection