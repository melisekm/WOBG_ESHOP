@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/profile.css")}}">
@endpush
@section('title', 'WOBG - Login')
@section("content")
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="background-rectangle px-5 py-4 mt-4 mb-5">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Sign In</h1>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{route("login")}}">
                        @csrf

                        <div class="container">
                            <div class="mb-3">
                                <label for="email" class="fs-5 form-label">E-mail</label>
                                <input id="email" class="form-control form-rounded" type="email" name="email"
                                       required autofocus value="{{old("email")}}"/>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="fs-5 form-label">Password:</label>
                                <input id="password" class="form-control form-rounded" type="password" name="password"
                                       required/>
                            </div>

                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label" for="remember_me"> Remember me </label>
                            </div>

                            <a class="white-link" href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                Forgot your password?
                            </a>

                            <div class="row">
                                <div class="col mt-3 text-center">
                                    <button class="btn btn-confirm btn-blue"> Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <!-- Modal -->
                    @include("auth.forgot-password-modal")
                    <div class="mt-4 pt-4 border-top text-center">
                        New customer? <a class="white-link d-inline-block" href="{{url("register")}}">Create a new
                            account</a>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
