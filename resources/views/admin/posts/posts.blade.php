@extends('app2')

@section('content')
    @foreach($posts as $post)
        <article>
            <a href="/admin/posts/{!! $post->slug !!}">
                <h2>{!! $post->title !!}</h2>
            </a>
            <p>
                {!! $post->excerpt !!}
            </p>
            <p>
                published: {{ $post->published_at  }}
            </p>
        </article>
    @endforeach
@stop