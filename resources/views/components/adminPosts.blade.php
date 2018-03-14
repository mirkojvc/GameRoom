@extends('layout')
@section('add_js')
<script src="{{asset('js/admin.js')}}"></script>
@endsection

@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
    <h1>Kreirajte post</h1>
    <div class = "admin_posts__errors"></div>
    <form  action="{{isset($post)? '/admin/posts/update/'.$post->id : '/admin/posts/save' }}" class = "admin_posts__form" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" value="{{isset($post)? $post->title : old('title') }}"/>
              </div>
              <div class="form-group">
                <label>Body:</label>
                <textarea name="text" class="form-control" rows="7">{{isset($post)? $post->text : old('text') }}</textarea>
              </div> 
              <div class="form-group">
                <label>Photo:</label>
                @if(isset($post))
                  <img src = "{{asset($post->first_image)}}" width="150"/>
                @endif
                <input type="file" name="image" class="form-control"  />
              </div>
              <div class="form-group">
                <label>Category:</label>
                <select class="form-control" name ="category" value="{{isset($post)? $post->categoryId : old('alt') }}" style="margin:10px 0;">
                        <option value = "0">Choose a category</option>
                    @foreach($categories as $category)
                        <option value = "{{$category->id}}" {{(isset($post)?$category->id === $post->categoryId? 'selected' : '': '')}}>{{$category->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <input type="submit" name="addPost" value="Add post" class="btn btn-default" />
              </div> 
            </form>

            
            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Title</td>
                  <td>Image</td>
                  <td>Text</td>
                  <td>Category</td>
                  <td>Update</td>
                  <td>Obrisi</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($posts)
                @foreach($posts as $post)
                  <tr>
                    <td> {{ $post->postId }} </td>
                    <td> {{ $post->title }} </td>
                    <td> <img src="{{ asset($post->first_image) }}" width="150"/> </td>
                    <td> {{ $post->text }} </td>
                    <td> {{ $post->name }} </td>
                    <td> <a href="{{ 'posts/'.$post->postId }}">Izmeni</a> </td>
                    <td> <a href="{{ 'posts/delete/'.$post->postId }}">Obrisi</a> </td>
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
