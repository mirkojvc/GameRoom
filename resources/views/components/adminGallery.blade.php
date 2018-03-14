@extends('layout')
@section('add_js')
<script src="{{asset('js/admin.js')}}"></script>
@endsection

@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
    <h1>Kreirajte post</h1>
    <div class = "admin_posts__errors"></div>
    <form  action="{{isset($image)? '/admin/gallery/update/'.$image->id : '/admin/gallery/save' }}" class = "admin_gallery__form" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                @if(isset($image))
                  <img src = "{{asset($image->url)}}" width="150"/>
                @endif
                <input type="file" name="image" class="form-control"  />
              </div>
              <div class="form-group">
                <input type="submit" name="addImage" value="Add image" class="btn btn-default" />
              </div> 
            </form>

            
            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Image</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($gallery)
                @foreach($gallery as $image)
                  <tr>
                    <td> {{ $image->id }} </td>
                    <td> <img src="{{ asset($image->url) }}" width="150"/> </td>
                    <td> <a href="{{ '/admin/gallery/'.$image->id }}">Izmeni</a> </td>
                    <td> <a href="{{ '/admin/gallery/delete/'.$image->id }}">Obrisi</a> </td>
                  </tr>
                @endforeach
                @endisset
            </table>
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
