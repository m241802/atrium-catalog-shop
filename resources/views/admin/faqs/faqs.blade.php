@extends('app2')

@section('content')
    @foreach($faqs as $faq)
        <article>
            <a href="/admin/faqs/{!! $faq->slug !!}">
                <h2>{!! $faq->title !!}</h2>
            </a>
            <p>
                {!! $faq->excerpt !!}
            </p>
            <p>
                published: {{ $faq->published_at  }}
            </p>
        </article>
    @endforeach
@stop