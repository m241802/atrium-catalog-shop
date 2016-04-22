@extends('app2')

@section('content')
    <h1>Update Faq: "{!! $post[0]->title !!}"</h1>
    {!! link_to_action('FaqsController@create', $title='Новая новость', $parameters = array(), $attributes = array()) !!}
    {!! link_to_action('FaqsController@destroy', $title = 'Удалить новость', $parameters = array('id' => $post[0]->id), $attributes = array()) !!}
    {!! Form::open(array('route' => 'faq.update', 'files' => true)) !!}
    @include('admin._form_with_data')
    {!! Form::close() !!}
@endsection