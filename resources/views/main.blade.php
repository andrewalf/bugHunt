<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    @if (session('success'))
        <div id="flash-message"  class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-end">
        <div class="col-auto">
            @if (@$logged_user)
                Привет, <b>{{ $logged_user->name }}</b>! <a href="{{ route('auth.logout') }}">Выйти</a>
            @endif
        </div>
    </div>

    @yield('content')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(function() {
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
