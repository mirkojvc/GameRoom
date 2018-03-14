@extends('layout')
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
        <h1>Welcome admin</h1>
      </div>

  </div>
@endsection

@section('menu')
<ul>
      <li><a href="/admin/posts">Postovi</a></li>
      <li><a href="/admin/categories">Kategorije</a></li>
      <li><a href="/admin/surveys">Ankete</a></li>
      <li><a href="/admin/gallery">Galerija</a></li>
    </ul>
@endsection