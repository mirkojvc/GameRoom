@extends('layout')
@section('add_js')
<script src="{{asset('js/admin.js')}}"></script>
@endsection
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
    <h1>Kreirajte anketu</h1>
    <div class = "admin_category__errors"></div>
    <form action="{{isset($answer)? '/admin/surveys/'.$survey->id.'/answer/update/'.$answer->id : '/admin/surveys/'.$survey->id.'/answer/save' }}" class = "admin_survey__form" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Title:</label>
                <input type="text" name="answer_text" class="form-control" value="{{isset($answer)? $answer->answer_text : old('answer_text') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addSurvey" value="Add survey answer" class="btn btn-default" />
              </div> 
            </form>

            
            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Name</td>
                  <td> Survey Name</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($answers)
                @foreach($answers as $answer)
                  <tr>
                    <td> {{ $answer->id }} </td>
                    <td> {{ $answer->answer_text }} </td>
                    <td> {{ $survey->name }} </td>
                    <td> <a href="{{ '/admin/surveys/'.$survey->id.'/answer/'.$answer->id }}">Izmeni</a> </td>
                    <td> <a href="{{ '/admin/surveys/'.$survey->id.'/answer/delete/'.$answer->id }}">Obrisi</a> </td>
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
