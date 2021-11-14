@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/profile.css")}}">
@endpush
@section('title', 'WOBG - Register')
@section("content")
    <main class="container">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <div class="background-rectangle px-5 py-4 mt-4 mb-5">
                            <div class="form-row">
                                <div class="col text-center">
                                    <h1>Sign Up </h1>
                                </div>
                            </div>

                            <div class="container">
                                <div class="mb-3">
                                    <label for="email" class="fs-5 form-label">E-mail:</label>
                                    <input id="email" class="form-control form-rounded" type="email" name="email"
                                           required autofocus/>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="fs-5 form-label">Password:</label>
                                    <input id="password" class="form-control form-rounded" type="password"
                                           name="password" required/>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation"
                                           class="fs-5 form-label">Confirm password:</label>
                                    <input id="password_confirmation" class="form-control form-rounded" type="password"
                                           name="password_confirmation" required/>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        I agree with
                                        <a class="white-link" href="{{url("privacy-policy")}}">Privacy policy</a> and <a
                                            class="white-link" href="{{url("privacy-policy")}}">Terms of
                                            use</a>
                                    </label>
                                </div>


                                <div class="row">
                                    <div class="col mt-3 text-center">
                                        <button type="submit" class="btn btn-confirm btn-blue">
                                            Create Account
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 border-top pt-4 text-center">
                                    Already have an account?&nbsp;<a class="white-link d-inline-block"
                                                                     href="{{url("login")}}">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
