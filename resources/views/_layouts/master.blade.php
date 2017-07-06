<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Seo tool &amp; Stuff</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
</head>
<body>

@yield('content')

<script src="{{ elixir('js/app.js') }}" ></script>
</body>
</html>
