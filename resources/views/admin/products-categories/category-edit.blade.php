@extends('app2')

@section('content')
<div>
    <h1>Update Category: "{!! $cat[0]->title !!}"</h1>
      {!! link_to_action('CategoriesController@create', $title='Новая категория', $parameters = array(), $attributes = array()) !!}
      {!! link_to_action('CategoriesController@destroy', $title = 'Удалить категорию', $parameters = array('id' => $cat[0]->id), $attributes = array()) !!}
      {!! Form::open(array('route' => 'hu.category', 'files' => true)) !!}
    {!! Form::hidden('id', $cat[0]->id, ['id'=>'id-element', 'class'=>'cats-produst']) !!}
    <div class="from-group">
        {!! Form::label('slug') !!}
        {!! Form::text('slug', $cat[0]->slug, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', $cat[0]->title, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        {!! Form::label('content') !!}
        {!! Form::textarea('content', $cat[0]->content, ['class'=>'form-control']) !!}
    </div>
    <div class="from-group">
        <h3>Родительские категотии</h3>
        <ul id="selected-cats" class="connectedSortable">
            @if(isset($cat[0]->parent_cat[0]))
            @for($i=0; $i<count($cat[0]->parent_cat); $i++ )
                <li class="ui-state-highlight">
                   <h5>{!! $cat[0]->parent_cat[$i]->title !!}</h5>
                   <input class="cats-produst" name="cats[]" type="hidden" value="{!! $cat[0]->parent_cat[$i]->id !!}">
                   <a href="link/to/recycle/script/when/we/have/js/off" title="Recycle this image" class="ui-icon ui-icon-refresh">Recycle cat</a>
                </li>
            @endfor
            @endif
        </ul>
    </div>
    <div class="from-group">
        <input type="file" multiple="multiple" name="images[]" />
    </div>
    <div class="from-group admin-fixed-button">
        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    </div>
    <div ng-controller="imgListCtrl" class="ui-widget-content ui-state-default ui-droppable">
        <h4 class="ui-widget-header"><span class="ui-icon ui-icon-selected-images">Выбранные картинки</span>Выбранные картинки</h4>
        <ul id="selected-images" class="gallery ui-helper-reset">
            @if($cat[0]->images)
            @foreach($cat[0]->images as $image)
                <li class="ui-widget-content ui-corner-tr" style="display: block; width: 48px;">
                    <h5 class="ui-widget-header">{!! $image->title !!}</h5>
                    <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[0] !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
                    <input name="images[]" type="hidden" value="{!! $image->id !!}">
                    <a href="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                    <a href="link/to/recycle/script/when/we/have/js/off" title="Recycle this image" class="ui-icon ui-icon-refresh">Recycle image</a>
                </li>
            @endforeach
            @endif
        </ul>
    </div>
    {!! Form::close() !!}    
    <div ng-app="catsApp" ng-controller="catsListCtrl">
        @include('admin.template.ang-categories')
        @include('admin.template.ang-images')
    </div>
</div>    
@endsection