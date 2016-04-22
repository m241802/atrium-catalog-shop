<ul id="selected-attrs" class="connectedSortable">
    <h4>Свойства продукта</h4>
    @if(isset($post[0]->attr[0]))
    @foreach($post[0]->attr as $item)            
        <li class="ui-state-highlight">
           <h5>{!! $item->title !!} - {!! $item->attr_tax !!}</h5>
           <input class="attrs-produst" name="attrs[]" type="hidden" value="{!! $item->id !!}">
        </li>
    @endforeach
    @endif
</ul>