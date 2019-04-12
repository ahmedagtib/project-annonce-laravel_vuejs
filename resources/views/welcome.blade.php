<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
           <meta name="csrf-token" content="{{csrf_token()}}">
        <!-- Fonts -->
          <link rel="stylesheet" type="text/css" href="{{asset('css_user/app.css')}}">

        <!-- Styles -->
       
    </head>
    <body>
        <div id="app">
             <upper></upper>
             <navbar></navbar>
             <router-view></router-view>
             <cfooter></cfooter>
        </div>
        <script type="text/javascript" src="{{asset('js_user/app.js')}}"></script>
    </body>
</html>
