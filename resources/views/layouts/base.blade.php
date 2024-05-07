<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags, stylesheets, and other head content -->
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>

        <!-- Login Form -->
        <div class="card">
            <div class="card-body login-card-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Scripts -->
</body>
</html>
