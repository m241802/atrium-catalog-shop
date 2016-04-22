@extends('app2')

@section('content')
    @foreach($news as $new)
        <article>
            <a href="/admin/news/{!! $new->slug !!}">
                <h2>{!! $new->title !!}</h2>
            </a>
            <p>
                {!! $new->excerpt !!}
            </p>
            <p>
                published: {!! $new->published_at !!}
            </p>
        </article>
    @endforeach
@stop