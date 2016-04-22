<div ng-click="startLoop('attrs-produst', 'attrs')">Выбрать из Атрибутов продуктов</div>        
<div ng-show="listAttrs">
    <h3>Все Атрибуты продуктов</h3>
    <ul id="attrs-list" class="connectedSortable">
        <input type="text" ng-model="query" placeholder="Поиск по категориям"> 
        <p>Общее количество Атрибутов продуктов: {{ attrs.length }}</p>
        <li class="ui-state-highlight" ng-repeat="attr in attrs | filter:query">
             <h5>{{ attr.title }} - {{ attr.attr_tax }}</h5>
            <input name="attrs[]" type="hidden" value="{{ attr.id }}">
            <span ng-click="addItem($event, 'selected-attrs')">+</span>
        </li>
    </ul>
</div>