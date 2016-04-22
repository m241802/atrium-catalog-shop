<div ng-click="startLoop('cats-produst', 'cats')">Выбрать из категорий</div>        
<div ng-show="listCats">
    <h3>Все категории</h3>
    <ul id="cats-list" class="connectedSortable">
        <input type="text" ng-model="query" placeholder="Поиск по категориям"> 
        <p>Общее количество категорий: {{ cats.length }}</p>
        <li class="ui-state-highlight" ng-repeat="cat in cats | filter:query">
            <h5>{{ cat.title }}</h5>
            <input name="cats[]" type="hidden" value="{{ cat.id }}">
            <span class="in-gallery" ng-click="addItem($event, 'selected-cats')">+</span>
        </li>
    </ul>
</div>