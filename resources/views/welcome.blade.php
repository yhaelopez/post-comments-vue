<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div id="app">
                        </div>

                    </div>
                </div>
            </div>
        </div>
         <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
