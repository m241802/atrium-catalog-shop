<div class="from-group admin-fixed-button">
    {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
</div>
<div class="from-group">
    {!! Form::label('slug') !!}
    {!! Form::text('slug', null, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    {!! Form::label('content') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    {!! Form::label('published') !!}
    {!! Form::checkbox('published', null, false) !!}
</div>
<div class="from-group">
    {!! Form::label('published_at') !!}
    {!! Form::input('date', 'published_at', date('Y-m-d'), ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    <input type="file" multiple="multiple" name="images[]" />
</div>
<h4>Галерея продукта</h4>
<ul id="selected-images"></ul>
<h4>Категории продукта</h4>
<ul id="selected-cats"></ul>
<h4>Свойства продукта</h4>
<ul id="selected-attrs"></ul>


