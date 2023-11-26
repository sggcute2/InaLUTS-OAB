<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
      @hasSection('title')
        @yield('title')
        &ndash;
      @endif
      {{ \Config::get('app.name') }}
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('FWAdmin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/base-theme.min.css') }}">
  </head>
  <body class="hold-transition login-page">
    <br><br>
    <div class="login-box">
      <div class="login-box-body">
        <div class="login-logo">
          <img src="{{ asset('img/logo-perkina-00.png') }}" alt="{{ \Config::get('app.name') }}" title="{{ \Config::get('app.name') }}" />
        </div><!-- /.login-logo -->
        <p class="login-box-msg">Sign in to enter administration page</p>
        @if(Session::has('error'))
        {{ BS::error(Session::get('error')) }}
        @endif

        @if(Session::has('warning'))
        {{ BS::warning(Session::get('warning')) }}
        @endif

        @if(Session::has('success'))
        {{ BS::info(Session::get('success')) }}
        @endif

        @yield('content')
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('FWAdmin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script>
      $(function () {
        @if(Session::has('error'))
        $('#password').focus();
        @else
        $('#username').focus();
        @endif
      });
    </script>
  </body>
</html>
