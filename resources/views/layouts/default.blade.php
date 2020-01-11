<!DOCTYPE html>
<html lang="{{str_replace('_','-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel='icon' type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = {csrfToken: '{{ csrf_token() }}'}</script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-reset.css')}}" rel="stylesheet">

    <!--external css-->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css')}}" type="text/css" />

    <!--right slidebar-->
    <link href="{{ asset('css/slidebars.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css')}}" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  </head>
  <body>
  <section id="container" class="">
 <!-- Left sidebar -->
    @include("layouts.header.left-slidebar")
       <!-- Navbar - top-header -->
       @include("layouts.header.top-header")

      <!--main content-->
      <section id="main-content">
              <!-- page -->
              @yield('content')
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
    <script defer type="text/javascript" src="{{ asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{ asset('js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{ asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/slidebars.min.js')}}"></script>
    <script src="{{ asset('js/respond.min.js')}}" ></script>
    <!--common script for all pages-->
   <script src="{{ asset('js/common-scripts.js')}}"></script>

  <!-- <script src="{{ asset('js/jquery.sparkline.js')}}" type="text/javascript"></script>
  <script src="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}"></script> -->
  <script defer src="{{ asset('js/owl.carousel.js')}}" ></script>
  <script defer src="{{ asset('js/jquery.customSelect.min.js')}}" ></script>
  <!--script for home page-->
  <!-- <script src="{{ asset('js/sparkline-chart.js')}}"></script>
  <script src="{{ asset('js/easy-pie-chart.js')}}"></script> -->
  <script src="{{ asset('js/count.js')}}"></script>

  </body>

</html>
