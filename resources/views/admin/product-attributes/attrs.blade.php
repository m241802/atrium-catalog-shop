@extends('app2')
@section('content')
   @foreach($attrs as $attr)
       <div>
           <a href="/admin/attr/{!! $attr->slug !!}/">
               {!! $attr->title !!}
           </a>
           {!! $attr->attr_tax !!}
           Категории:
           @foreach($attr->cat_ids as $cat)
               <a href="/admin/category/{!! $cat->slug !!}/">{!! $cat->title !!}</a>
           @endforeach
       </div>
   @endforeach
@endsection