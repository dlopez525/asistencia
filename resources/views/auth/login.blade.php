<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/azia.css') }}" rel="stylesheet">
    <title>Login</title>
    <style>
        .logo-img {
            width: auto;
            height: 200px;
        }
    </style>
</head>
<body class="az-body" style="background-image: url({{ asset('img/fondo.jpg') }})">
    <div class="az-signin-wrapper">
        <div class="az-card-signin" style="background: #fff;">
            {{-- <h1 class="az-logo">amade<span>u</span>s</h1> --}}
            <img src="{{ asset('img/logo.jpeg') }}" class="logo-img" alt="">
            <div class="az-signin-header">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-az-primary btn-block">Iniciar Sesión</button>
                </form>
            <div>
        </div>
    </div>
</body>
</html>