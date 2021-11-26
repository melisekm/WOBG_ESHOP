@extends("layout.app")
@section("content")
    <main class="container">
        <div class="row mb-5 mt-3">
            @include('admin.sidebar')
            @yield('admin-content')
        </div>
    </main>
@endsection
