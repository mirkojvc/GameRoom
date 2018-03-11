@extends('layout')
@section('add_js')
<script src="{{asset('js/index.js')}}"></script>
@endsection
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
      <div id = "content_main">
      @include('components.articleSingleCompact')
      @if(Session::get('user') !== null)
        @include('components.survey')
      @endif
      </div>
  </div>
  </div>
@endsection

@section('menu')
<ul>
      
      @foreach($categories as $category)
      <li><a href="/category/{{$category->id}}">{{$category->name}}</a></li>
      @endforeach
    </ul>
@endsection