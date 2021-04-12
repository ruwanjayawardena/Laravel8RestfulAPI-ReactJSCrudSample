<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/app.css')}}" rel="stylesheet" />
        <link href="{{asset('css/custom-style.css')}}" rel="stylesheet" />
        <title>Sinha Hardware POS</title>       
    </head>
    <body class="h-100">        
        <div id="app" class="h-100"></div>
        <script src="{{asset('js/app.js')}}"></script>
    </body> 
</html>
