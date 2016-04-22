@extends('app2')

@section('content')
<div id="admin-content" ng-app="catsApp" ng-controller="catsListCtrl">
    <h1>Update Category: "{!! $cat[0]->title !!}"</h1>
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
        <ul id="sortable1" class="connectedSortable">
            @if(isset($cat[0]->parent_cat[0]))
            @for($i=0; $i<count($cat[0]->parent_cat); $i++ )
                <li class="ui-state-highlight">
                   <h5>{!! $cat[0]->parent_cat[$i]->title !!}</h5>
                   <input class="cats-produst" name="parent_cat[]" type="hidden" value="{!! $cat[0]->parent_cat[$i]->id !!}">
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
    <div id="selected-images" class="ui-widget-content ui-state-default ui-droppable">
        <h4 class="ui-widget-header"><span class="ui-icon ui-icon-selected-images">Выбранные картинки</span>Выбранные картинки</h4>
        <ul class="gallery ui-helper-reset">
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
        <div ng-click="startLoopCats()">Выбрать из категорий</div>        
        <div ng-show="customCats">
            <h2>Категории</h2>
            <ul id="sortable2" class="connectedSortable">
                <input type="text" ng-model="query" placeholder="Поиск по категориям"> 
                <p>Общее количество категорий: {{ cats.length }}</p>
                <li class="ui-state-highlight" ng-repeat="cat in cats | filter:query">
                    <h5>{{ cat.title }}</h5>
                    <input name="parent_cat[]" type="hidden" value="{{ cat.id }}">
                </li>
            </ul>
        </div>
        <!-- <div ng-click="startLoopImages()" style="padding: 10px;">Выбрать из картинок</div>        
        <div ng-show="customImages">
            <h2>Картинки</h2>            
            <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix ui-droppable">            
                <input type="text" ng-model="query" placeholder="Поиск в картинках"> 
                <p>Общее количество картинок: {{ images.length }}</p>
                <li class="ui-widget-content ui-corner-tr" ng-repeat="image in imgs | filter:query">
                    <h5 class="ui-widget-header">{{ image.slug }}</h5>                
                    <img src="/uploads/img/{{ image.destinationPath }}/{{ image.slug }}-{{ image.size[0] }}.{{ image.type }}" alt="{{ image.title }}">
                    <input name="images[]" type="hidden" value="{{ image.id }}">
                    <a href="/uploads/img/{{ image.destinationPath }}/{{ image.slug }}.{{ image.type }}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                    <a ng-click="addImage($event)">+</a>
                </li>            
            </ul>
        </div> -->
       
    <ul >
        <input type="text" value="ItemName" ng-model="newItemName" placeholder="name of new item...">
        <button ng-click="addItem()">Add Me</button>
        <li ng-repeat="item in items.data" id="{{item.id}}"> 
        <a href="#">{{item.title}}</a>  
        <a ng-click="addImage($event)" class="delete-item">x</a>

        </li>
    </ul>
   

    </div>
</div>    
@endsection