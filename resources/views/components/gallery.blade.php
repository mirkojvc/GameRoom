@extends('layout')
@section('add_js')
<script src="{{asset('js/index.js')}}"></script>
@endsection
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font: 14px/1 'Open Sans', sans-serif;
  color: #555;
  background: #e5e5e5;
}

.gallery {
  width: 640px;
  margin: 0 auto;
  padding: 5px;
  background: #fff;
  box-shadow: 0 1px 2px rgba(0,0,0,.3);
}

.gallery > div {
  position: relative;
  float: left;
  padding: 5px;
}

.gallery > div > img {
  display: block;
  width: 200px;
  transition: .1s transform;
  transform: translateZ(0); /* hack */
}

.gallery > div:hover {
  z-index: 1;
}

.gallery > div:hover > img {
  transform: scale(1.7,1.7);
  transition: .3s transform;
}

.cf:before, .cf:after {
  display: table;
  content: "";
  line-height: 0;
}

.cf:after {
  clear: both;
}

h1 {
  margin: 40px 0;
  font-size: 30px;
  font-weight: 300;
  text-align: center;
}
</style>
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
      <div id = "content_main">
          <div class="gallery cf">
              @foreach($gallery as $image)
              <div>
                <img src="{{asset($image->url)}}" />
              </div>
              @endforeach
            </div>
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