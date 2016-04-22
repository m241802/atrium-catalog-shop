@extends('app2')

@section('content')
    <h1>Import</h1>
    {!! Form::open(array('route' => 'importProduct', 'files' => true)) !!}
    <div class="from-group">
        {!! Form::select('Type post', array('product' => 'product', 'new' => 'new', 'post' => 'post')); !!}
    </div>
    <div class="from-group">
        <input type="file" name="image">
    </div>
    <div class="from-group">
        {!! Form::submit('Upload', ['class'=>'btn btn-primary', 'multiple']) !!}
    </div>
    {!! Form::close() !!}
@endsection
