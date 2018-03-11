@extends('layout')
@section('add_js')
<script src="{{asset('js/admin.js')}}"></script>
@endsection
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">
    <h1>Kreirajte anketu</h1>
    <div class = "admin_category__errors"></div>
    <form action="{{isset($survey)? '/admin/survey/update/'.$survey->id : '/admin/survey/save' }}" class = "admin_survey__form" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Title:</label>
                <input type="text" name="name" class="form-control" value="{{isset($survey)? $survey->name : old('name') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addSurvey" value="Add survey" class="btn btn-default" />
              </div> 
            </form>

            
            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Name</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($surveys)
                @foreach($surveys as $survey)
                  <tr>
                    <td> {{ $survey->id }} </td>
                    <td> {{ $survey->name }} </td>
                    <td> <a href="{{ 'surveys/'.$survey->id.'/answer' }}">Dodaj pitanje</a> </td>
                    <td> <a href="{{ 'surveys/'.$survey->id.'/results' }}">Rezultati</a> </td>
                    <td> <a href="{{ 'surveys/'.$survey->id }}">Izmeni</a> </td>
                    <td> <a href="{{ 'survey/delete/'.$survey->id }}">Obrisi</a> </td>
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
    </ul>
@endsection
