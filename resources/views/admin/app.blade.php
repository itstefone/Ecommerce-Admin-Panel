<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title> @yield('title') - {{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href={{asset('/backend/css/main.css')}}>
    <!-- Font-icon css-->
    @yield('styles')

 
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
   @include('admin.partials.header')
    <!-- Sidebar menu-->
   @include('admin.partials.side-bar-menu')
    <main id="app" class="app-content">
      
      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script  src="{{asset('/backend/js/app.js')}}" ></script>
    <script    src="{{asset('/backend/js/jquery-3.3.1.min.js')}}"></script>
    <script   src="{{asset('/backend/js/popper.min.js')}}" ></script>
    <script  src="{{asset('/backend/js/bootstrap.min.js')}}" ></script>
    <script  src="{{asset('/backend/js/main.js')}}" ></script>
   
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('/backend/plugins/pace.min.js')}}"></script>

   
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>




@yield('scripts')
  </body>
</html>