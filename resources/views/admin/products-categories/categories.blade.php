@extends('app2')
@section('content')
    <div class="admin-cats-page">
           <ul class="cats-level1">
    @foreach($cats as $cat)

        <li class="cat">
            @if($cat->children!=array())
                <div class="click-cat no-show-child"></div>
            @endif
            <a href="/admin/category/{!! $cat->slug !!}">
                <h3>{!! $cat->title !!}</h3>
            </a>
            @if(isset($cat->children))
               <ul class="cats-level2 <?php if(!isset($cat->child_status)){ echo "display-none"; }?>">
                  @foreach($cat->children as $child)
                      <li class="cat-child">
                           @if(isset($child->children))
                               <div class="click-cat no-show-child"></div>
                           @endif
                           <a href="/admin/category/{!! $child->slug !!}">
                               <h5>{!! $child->title !!}</h5>
                           </a>
                           @if(isset($child->children))
                               <ul class="cats-level3 <?php if(!isset($child2->child_status)){ echo "display-none"; }?>">
                                   @foreach($child->children as $child2)
                                       <li class="cat-child">
                                          @if(isset($child2->children))
                                            <div class="click-cat no-show-child"></div>
                                          @endif
                                          <a href="/admin/category/{!! $child2->slug !!}">
                                            <h6>{!! $child2->title !!}</h6>
                                          </a>
                                          @if(isset($child2->children))                                   
                                            <ul class="cats-level4 display-none">
                                              @foreach($child2->children as $child3)
                                                <li class="cat-child">
                                                  <a href="/admin/category/{!! $child3->slug !!}">
                                                    <h6>{!! $child3->title !!}</h6>
                                                  </a>
                                                </li>
                                              @endforeach
                                            </ul>
                                          @endif
                                       </li>
                                   @endforeach
                               </ul>
                           @endif
                      </li>
                  @endforeach
               </ul>
            @endif
        </li>
    @endforeach
    </ul>
    </div>
@stop