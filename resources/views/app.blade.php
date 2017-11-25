<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Qwilr - @yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <div id="app" class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">Stock portfolio</a>
                    </div>
                    <div id="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Net assets: ${{ total_asset_value() }}</a></li>
                            <li><a href="#">Current balance: ${{ session('amount') }}</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @yield('content')

        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
