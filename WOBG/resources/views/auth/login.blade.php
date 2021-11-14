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
                    </div>

                    <form method="POST" action="{{route("login")}}">
                        @csrf

                        <div class="container">
                            <div class="mb-3">
                                <label for="email" class="fs-5 form-label">E-mail</label>
                                <input id="email" class="form-control form-rounded" type="email" name="email"
                                       required autofocus/>
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

                            <a class="white-link" href="#" data-bs-toggle="modal"
                               data-bs-target="#forgotPasswordModal">Forgot your password?</a>
                            <div class="row">
                                <div class="col mt-3 text-center">
                                    <button class="btn btn-confirm btn-blue"> Sign In</button>
                                </div>
                            </div>
                        </div>

                    </form>


                    <!-- Modal -->
                    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModal"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row ">
                                            <p class="modal-p">
                                                We will send you an email to reset your password.
                                            </p>
                                            <div class="mb-3">
                                                <label for="contactForm-city" class="modal-label">Email</label>
                                                <input type="email" id="contactForm-city" class="form-control">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="button" class="btn btn-blue" data-bs-dismiss="modal">Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-top text-center">
                        New customer? <a class="white-link d-inline-block" href="">Create a new account</a>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>

@endsection
