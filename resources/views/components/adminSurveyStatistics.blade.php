@extends('layout')
@section('add_js')
<script src="{{asset('js/admin.js')}}"></script>
@endsection
@section('content')
  <div id="content" class="mobileUI-main-content">
    <div id="content-inner">   
        <h1 style = "text-transform:uppercase;">{{$survey->name}}</h1>
            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Answer text</td>
                  <td>Score</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($statistics)
                @foreach($statistics as $statistic)
                  <tr>
                    <td> {{ $statistic['answerId'] }} </td>
                    <td> {{ $statistic['answer_text'] }} </td>
                    <td> {{$statistic['result']}} </td>
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
