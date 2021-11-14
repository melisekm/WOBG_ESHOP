@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/profile.css")}}">
@endpush
@section('title', 'World of Board Games')
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
                                    <label for="email" class="fs-5 form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" class="form-control form-rounded" type="email" name="email"
                                           :value="old('email')" required/>

                                </div>

                                <div class="mb-3">
                                    <label for="password" class="fs-5 form-label">{{ __('Password') }}</label>
                                    <input id="password" class="form-control form-rounded" type="password" name="password"
                                           required/>


                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm" class="fs-5 form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" class="form-control form-rounded" type="password"
                                           name="password_confirmation" required/>

                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        I agree with
                                        <a class="white-link" href="">Privacy policy</a> and <a
                                            class="white-link" href="">Terms of
                                            use</a>
                                    </label>
                                </div>


                                <div class="row">
                                    <div class="col mt-3 text-center">
                                    <button type="submit" class="btn btn-confirm btn-blue">
                                        {{ __('Register') }}
                                    </button>
                                    </div>
                                    {{--                                    <div class="col mt-3 text-center">--}}
                                    {{--                                        <a href="register_success.html" class="btn btn-confirm btn-blue"> Create Account </a>--}}
                                    {{--                                    </div>--}}
                                </div>

                                <div class="mt-4 border-top pt-4 text-center">
                                    Already have an account?&nbsp;<a class="white-link d-inline-block"
                                                                     href="">Sign In</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>

    </main>
@endsection
