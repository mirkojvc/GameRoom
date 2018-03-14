@extends('layout')
@section('add_js')
<script src="{{asset('js/index.js')}}"></script>
@endsection
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
      <div id = "content_main">
        <img src="{{ asset('images/me.jpg') }}" width="300" />
        <h1>Mirko Jovic 33/15 student Visoke ICT skole</h1>
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