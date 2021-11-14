<!DOCTYPE html>
<html lang="en">
@include('layout.partials.head')
<body class="d-flex flex-column min-vh-100">
@include('layout.partials.nav')
<main class="container">
    @yield('content')
</main>
@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
</body>
</html>
