<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>InoTravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&amp;subset=cyrillic" rel="stylesheet"> 

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/welcome.css" rel="stylesheet">
        <link href="/css/searchBar.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
        

    </head>
    <body>
        <div id="app"></div>


        <script src="/js/app.js"></script>
    </body>
</html>
