@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/profile.css")}}">
@endpush
@section('title', 'World of Board Games')
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

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif


                        <a class="white-link " href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot
                            your password?</a>

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

                                <div class="row">
                                    <div class="col mt-3 text-center">
                                        <button class="btn btn-confirm btn-blue">
                                            {{ __('Log in') }}
                                        </button>
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
