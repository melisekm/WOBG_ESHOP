@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/checkout.css")}}">
@endpush
@section('title', 'WOBG - Profile')
@section("content")
    <main class="container mt-3 mb-5 order-links">
        <div class="tab-content ps-xl-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-personal-details" role="tabpanel"
                 aria-labelledby="pills-personal-details-tab">
                <h1 class="mb-5">Personal Details</h1>
                @if(session()->has('errors'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                            @if($errors->has("phone_number"))
                                <li>Valid phone number format must start with + and contain only digits. eg.
                                    +123456789
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="row px-3 gx-5">
                    <div class="col-lg-4 col">
                        <form method="POST" action="{{route("profile.update")}}">
                            @csrf

                            <i class="fas fa-envelope prefix"></i>
                            <label for="email" class="fs-5 form-label ">E-mail</label>
                            <input required id="email" type="text" class="form-control" name="email"
                                   value="{{auth()->user()->email}}">
                            <i class="fas fa-phone prefix"></i>
                            <label for="phoneNumber" class="fs-5 mt-1 form-label ">Phone number</label>
                            <input id="phoneNumber" type="text" class="form-control" name="phone_number"
                                   placeholder="include international prefix e.g. +421"
                                   value="{{auth()->user()->phone_number}}">

                            <button class="btn mt-4 btn-blue form-control">Save Changes</button>
                        </form>

                        <hr class="border rounded border-dark border-3 my-4">
                        <button class="btn btn-blue form-control" data-bs-toggle="modal"
                                data-bs-target="#changePasswordModal"> Change password
                        </button>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <i class="fas fa-home prefix"></i>
                            <label for="TextareaAddress" class="fs-5 form-label mt-md-0 mt-3">Address</label>
                            {{--    @formatter:off--}}
                            <textarea disabled class="form-control rounded-2" id="TextareaAddress" rows="5">
{{auth()->user()->first_name . " " . auth()->user()->surname}}
{{auth()->user()->street}}
{{auth()->user()->city . " " . auth()->user()->postal_code}}
{{auth()->user()->country}}
                        </textarea>
                            {{--    @formatter:on--}}

                        </div>
                        <div class="mt-2">
                            <button class="btn btn-outline-dark form-control" data-bs-toggle="modal"
                                    data-bs-target="#editAddress">Edit
                            </button>
                        </div>
                        @can('viewAdmin', App\Models\Product::class)
                            <hr class="border rounded border-dark border-3 my-4">
                            <a class="btn btn-success form-control" href="{{route("admin.index")}}">
                                ADMIN DASHBOARD
                            </a>
                        @endcan
                    </div>
                    @include("components.modals.address-modal")
                    @include("auth.reset-password-modal")
                </div>
            </div>
        </div>

    </main>

@endsection
