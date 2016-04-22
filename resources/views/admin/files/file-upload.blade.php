@extends('app2')

@section('content')
    <h1>Upload file(s)</h1>
    {!! Form::open(array('route' => 'hendler.file', 'files' => true)) !!}
    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
    name <input type="text" name="name" id="">
    <br>
    image <input type="file" name="image[]"multiple>
    <br>
    <button type="submit">Submit</button>
    {!! Form::close() !!}

@endsection