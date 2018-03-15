<!DOCTYPE HTML>
<html>
<head>
<title>Striped</title>
<meta charset="utf-8">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/5grid/core-desktop.css') }}">
<link rel="stylesheet" href="{{ asset('css/5grid/core.css') }}">
<link rel="stylesheet" href="{{ asset('css/5grid/core-1200px.css') }}">
<link rel="stylesheet" href="{{ asset('css/5grid/core-noscript.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/style-desktop.css') }}">
<link rel="stylesheet" href="{{ asset('css/style-1200px.css') }}">
</noscript>
</head>
<body class="left-sidebar">

@if (session('login_error'))
  <div style="color:red;">{{session('login_error')}}</div>
@endif

@if (session('error'))
  <div style="color:red;">{{session('error')}}</div>
@endif

@isset($errors)
  @if($errors->any())
    @foreach($errors->all() as $error)
      <div style="color:red;"> {{ $error }} </div>
    @endforeach
  @endif
@endisset
<div id="wrapper">
@yield('content')
  <div id="sidebar">
    <div id="logo">
    <a href = "/" style="text-decoration:none">
      <h1 class="mobileUI-site-name">GameRoom</h1>
    </a>
    </div>
    <nav id="nav" class="mobileUI-site-nav">
    @yield('menu')

    </nav>
    <section class="is-search is-first">

@if(Session::get('user') === null)
      <form method="post" class = "user_form" action="{{route('userForm')}}">
      {{ csrf_field() }}
        <ul class = "login_form">
        <li>
        <input type="text" class="text user_username" name="username" placeholder="username">
        </li>
        <li>
        <input type="password" class="text user_password" name="password" placeholder="password">
        </li>
        <li>
            <input type="submit"  value = "register" name="register_submit">
        </li>
        <li>
            <input type="submit"  value = "login" name="login_submit">
        </li>
        <li class = "user_form__error"></li>
        </ul>
      </form>
@else 
      <ul>
        <li>Zdravo {{Session::get('user')[0]->username}}</li>
        <li>
          <form method="post" action= "{{route('logout')}}">
          {{ csrf_field() }}
            <input type="submit" value="Logout"/>
          </form>
        </li>
      </ul>
@endif
    </section>
    <section class="is-recent-posts">

      <ul>
        <li><a href="/gallery">Galerija</a></li>
        <li><a href="/author">Autor</a></li>
        <li><a href="/documentation">Dokumentacija</a></li>
      </ul>
    </section>
    <div id="copyright">
    </div>
  </div>
</div>

   <script type="text/javascript">
      const baseUrl = '{{ route("home") }}';
    </script>

<script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{asset('js/AppMainAjax.js')}}"></script>
@yield('add_js')
<script src="{{ asset('css/5grid/init.js?use=mobile,desktop,1200px,1000px&amp;mobileUI=1&amp;mobileUI.theme=none') }}"></script>
<noscript>
</body>
</html>



