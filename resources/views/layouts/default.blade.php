<!DOCTYPE html>
<html lang="{{str_replace('_','-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel='icon' type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),]); ?></script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />

    <!--right slidebar-->
    <link href="{{ asset('css/slidebars.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css')}}" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <body>
  <section id="container" class="">
 <!-- Left sidebar -->
    @include("layouts.header.left-slidebar")
     @include('notification')
       <!-- Navbar - top-header -->
       @include("layouts.header.top-header")

      <!--main content-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page -->
              @yield('content')
          </section>
{{--          <notifications group="notifi" position="top left" />--}}
      </section>
      <!--footer-->
      <footer class="site-footer">
          <div class="text-center">
              Project by Vu Thi Hoan 2019-2020 .
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{ asset('js/slidebars.min.js')}}"></script>
    <script src="{{ asset('js/respond.min.js')}}" ></script>

</script>
    <!--common script for all pages-->
    <!-- <script src="{{ asset('js/common-scripts.js')}}"></script> -->


  </body>

</html>
