<div class="ui-widget-content ui-state-default ui-droppable">
    <h4 class="ui-widget-header"><span class="ui-icon ui-icon-selected-images">Выбранные картинки</span>Выбранные картинки</h4>
    <ul id="selected-images" class="gallery ui-helper-reset">
        @if(isset($post[0]->images[0]))
            @foreach($post[0]->images as $image)
                <li class="ui-widget-content ui-corner-tr" style="display: block; width: 48px;">
                    <h5 class="ui-widget-header">{!! $image->slug !!}</h5>
                    <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[0] !!}.{!! $image->type !!}" alt="{!! $image->slug !!}.{!! $image->type !!}" width="96" height="72" style="display: inline-block; height: 36px;">
                    <input class="imgs-produst" name="images[]" type="hidden" value="{!! $image->id !!}">
                    <a href="/uploads/img/{!! $image->slug !!}.{!! $image->type !!}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                    <a href="link/to/recycle/script/when/we/have/js/off" title="Recycle this image" class="ui-icon ui-icon-refresh">Recycle image</a>
                </li>
            @endforeach
        @endif    
    </ul>
</div>