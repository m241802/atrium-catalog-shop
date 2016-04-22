{!! Form::hidden('id', $post[0]->id, ['id'=>'id-element']) !!}
<div class="from-group">
    {!! Form::label('slug') !!}
    {!! Form::text('slug', $post[0]->slug, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', $post[0]->title, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    {!! Form::label('content') !!}
    {!! Form::textarea('content', $post[0]->content, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    {!! Form::label('published_at') !!}: "{!! $post[0]->published_at !!}"
    {!! Form::input('date', 'published_at', $post[0]->published_at, ['class'=>'form-control']) !!}
</div>
<div class="from-group">
    @include('admin.template.categories-start')
</div>
@include('admin.template.images-start')
<div class="from-group">
    <input type="file" multiple="multiple" name="images[]" />
</div>
<div class="from-group admin-fixed-button">
    {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
</div>