@extends('app2')

@section('content')
    <h1>Edit Attribute Product</h1>
    {!! Form::open(array('route' => 'hu.attr')) !!}
    <div class="from-group admin-fixed-button">
        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::hidden('id', $attr[0]->id, ['class'=>'form-control']) !!}
    <div class="from-group">
        {!! Form::label('slug') !!}
        {!! Form::text('slug', $attr[0]->slug, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', $attr[0]->title, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('product tax') !!}
        {!! Form::text('attr_tax', $attr[0]->attr_tax, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        <ul id="sortable1" class="connectedSortable">
            {!! Form::label('id category') !!}
            @if(isset($attr[0]->cat_ids[0]))
                @for($i=0; $i<count($attr[0]->cat_ids); $i++ )
                    <li class="ui-state-highlight">
                        <h5>{!! $attr[0]->cat_ids[$i]->title !!}</h5>
                        <input name="cat_ids[]" type="hidden" value="{!! $attr[0]->cat_ids[$i]->id !!}">
                        {{--  <a href="link/to/recycle/script/when/we/have/js/off" title="Recycle this image" class="ui-icon ui-icon-refresh">Recycle cat</a>--}}
                    </li>
                @endfor
            @endif
        </ul>
    </div>
    {!! Form::close() !!}
    <ul id="sortable2" class="connectedSortable">
        <h5>Категории</h5>
        @for($i=0; $i<count($cats); $i++ )
            <li class="ui-state-highlight">
                <h5>{!! $cats[$i]->title !!}</h5>
                <input name="cat_ids[]" type="hidden" value="{!! $cats[$i]->id !!}">
                {{-- <a href="link/to/selected-images/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-selected-images">Delete image</a>--}}
            </li>
        @endfor
    </ul>
@endsection