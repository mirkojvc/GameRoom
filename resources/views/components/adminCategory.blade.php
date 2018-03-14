@extends('layout')
@section('add_js')
<script src="{{asset('js/admin.js')}}"></script>
@endsection
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
    <h1>Kreirajte kategoriju</h1>
    <div class = "admin_category__errors"></div>
    <form action="{{isset($category)? '/admin/categories/update/'.$category->id : '/admin/categories/save' }}" class = "admin_category__form" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Title:</label>
                <input type="text" name="name" class="form-control" value="{{isset($category)? $category->name : old('name') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addPost" value="Add category" class="btn btn-default" />
              </div> 
            </form>

            
            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Name</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($categories)
                @foreach($categories as $category)
                  <tr>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->name }} </td>
                    <td> <a href="{{ 'categories/'.$category->id }}">Izmeni</a> </td>
                    <td> <a href="{{ 'categories/delete/'.$category->id }}">Obrisi</a> </td>
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
