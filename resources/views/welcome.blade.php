<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
</head>
<body class="antialiased">
    @error('ip_host')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <form action="{{route('create.ip')}}" method="post">
        @csrf
        <p>ip:port</p>
        <input type="text" name="ip_hosts[]">
        <br>
        <input type="text" name="ip_hosts[]">
        <br>
        <input type="submit" value="Проверить">
    </form>
    <div>
        etxtetx
        {{$hash ?? ''}}
    </div>
</body>
</html>
