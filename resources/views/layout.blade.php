<!DOCTYPE HTML>
<html>
<head>
<title>Striped</title>
<meta charset="utf-8">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet">
<script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{asset('js/AppMainAjax.js')}}"></script>
@yield('add_js')
<script src="{{ asset('css/5grid/init.js?use=mobile,desktop,1200px,1000px&amp;mobileUI=1&amp;mobileUI.theme=none') }}"></script>
<noscript>
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
<div id="wrapper">
@yield('content')
  <div id="sidebar">
    <div id="logo">
      <h1 class="mobileUI-site-name">STRIPED</h1>
    </div>
    <nav id="nav" class="mobileUI-site-nav">
    @yield('menu')

    </nav>
    <section class="is-search is-first">
      <form method="post" action="#">
        <ul class = "login_form">
        <li>
        <input type="text" class="text" name="username" placeholder="username">
        </li>
        <li>
        <input type="password" class="text" name="password" placeholder="password">
        </li>
        <li>
            <input type="submit"  value = "register" name="register_submit">
        </li>
        <li>
            <input type="submit"  value = "login" name="login_submit">
        </li>
        </ul>
      </form>
    </section>
    <section class="is-recent-posts">

      <ul>
        <li><a href="#">Autor</a></li>
        <li><a href="#">Dokumentacija</a></li>
      </ul>
    </section>
    <div id="copyright">
    </div>
  </div>
</div>
</body>
</html>