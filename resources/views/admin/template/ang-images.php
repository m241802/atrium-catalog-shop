<div ng-click="startLoop('imgs-produst', 'images')">Выбрать из картинок</div>        
<div ng-show="listImages">
    <h2>Картинки</h2>            
    <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix ui-droppable">            
        <input type="text" ng-model="query" placeholder="Поиск в картинках"> 
        <p>Общее количество картинок: {{ images.length }}</p>
        <li id="{{ image.id }}" class="ui-widget-content ui-corner-tr" ng-repeat="image in imgs | filter:query">
            <h5 class="ui-widget-header">{{ image.slug }}</h5>                
            <img src="/uploads/img/{{ image.destinationPath }}/{{ image.slug }}-{{ image.size[0] }}.{{ image.type }}" alt="{{ image.title }}">
            <input name="images[]" type="hidden" value="{{ image.id }}">
            <a href="/uploads/img/{{ image.destinationPath }}/{{ image.slug }}.{{ image.type }}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
            <span class="in-gallery" ng-click="addItem($event, 'selected-images')">+</span>
        </li>            
    </ul>
</div>