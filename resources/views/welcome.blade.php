<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            *{
                margin: 0;
                padding: 0;
                font-family: 'Nunito', sans-serif;
            }
            html, body {
                color: #636b6f;
                background-color: #fff;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script src=" {{ asset('js/app.js') }} "></script>
    </body>
</html>
