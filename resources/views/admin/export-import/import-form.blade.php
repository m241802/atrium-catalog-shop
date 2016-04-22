@extends('app2')
dd($file_arr);
@section('content')
    <h1>Import</h1>
    {!! Form::open(array('route' => 'handlerImport')) !!}
    <h4>Create product</h4>
    <input type="hidden" name="type_import" value="product">
    <div class="from-group">
        {!! Form::label('артикл') !!}
        {!! Form::text('sku', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('цена') !!}
        {!! Form::text('price', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('еденица измерения') !!}
        {!! Form::text('unit_of_measure', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('валюта цены') !!}
        {!! Form::text('price_currency', null, ['class'=>'form-control']) !!}
    </div>
    @include('admin._form')
    <div class="from-group">
        {!! Form::label('images') !!}
        {!! Form::text('images', null, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
           {!! Form::label('images') !!}
           {!! Form::textarea('images', null, ['class'=>'form-control']) !!}
       </div>
    <h4>Create attribute product</h4>
    @include('admin._form_attr')
    <h4>Create category product</h4>
    @include('admin._form_category')
    {!! Form::close() !!}
@endsection
<div class="import_arr">
    @foreach($file_arr as $line)
        <div class="slide">
            @foreach($line as $key => $value)
                <p>
                    {!! $value !!} - {!! $key !!}
                </p>
            @endforeach
        </div>
    @endforeach
</div>