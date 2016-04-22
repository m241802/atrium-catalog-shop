<ul id="selected-cats" class="connectedSortable">
    @if(isset($post[0]->cats[0]))
    @foreach($post[0]->cats as $cat)            
        <li class="ui-state-highlight">
           <h5>{!! $cat->title !!}</h5>
           <input class="cats-produst" name="cats[]" type="hidden" value="{!! $cat->id !!}">
        </li>
    @endforeach
    @endif
</ul>