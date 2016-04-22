@extends('app2')

@section('content')
    <h3>Картинки</h3>
    @foreach($images as $image)
        <article class="loop-images">
            <a  title="изменить" href="/admin/images/{!! $image->slug !!}">
                <h4>{!! $image->title !!}</h4>
            </a>
            <p>
                <a title="увиличить" rel="example_group" href="/uploads/img/{!! $image->slug !!}" class="button">
                    <img src="/uploads/img/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[1] !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
                </a>
            </p>
            <p>
              {{ $image->created_at  }}
            </p>
        </article>
    @endforeach
@stop