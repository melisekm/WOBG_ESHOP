@php
    $options = ["Slovakia","Czech Republic", "Hungary", "United Kingdom"];
@endphp
@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/checkout.css")}}">
@endpush
@section('title', 'WOBG - Checkout')
@section("content")
    <main class="container">
        <!--    Kroky checkoutu-->
        <ul class="timeline mt-4 ">
            <li class="step complete">
                <div class="status">
                    <div><a href="#" class="black-link">Information</a></div>
                </div>
            </li>
            <li class="step">
                <div class="status">
                    <div>Review</div>
                </div>
            </li>
            <li class="step">
                <div class="status">
                    <div>Payment</div>
                </div>
            </li>
            <li class="step">
                <div class="status">
                    <div>Done</div>
                </div>
            </li>
        </ul>
        <h1 class="my-3 display-6">Checkout</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row my-3">
            <!--    Info-->
            <div class="col-lg-6 mt-lg-0 mt-3 order-2 order-lg-1">
                <form method="POST" action="{{route("checkout.review")}}">
                    @csrf
                    <section>
                        <h2 class="fs-4 mb-2">Billing information</h2>
                        @if(!auth()->check())
                            <p>
                                Already have an account? <a href="{{url("login")}}" class="black-link">Sign
                                    in</a><br>
                                Or continue as a guest:
                            </p>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" value="{{old("email",$user->email)}}"
                                           class="form-control"
                                           id="email">
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col mb-3">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" name="first_name" value="{{old("first_name",$user->first_name)}}"
                                       class="form-control"
                                       id="firstName">
                            </div>
                            <div class="col mb-3">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" name="surname" value="{{old("surname",$user->surname)}}"
                                       class="form-control"
                                       id="surname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="street" class="form-label">Street</label>
                                <textarea class="form-control" name="street" id="street"
                                          rows="3">{{$user->street}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" value="{{old("city",$user->city)}}" class="form-control"
                                       id="city">
                            </div>
                            <div class="col mb-3">
                                <label for="postalCode" class="form-label">Postal Code</label>
                                <input type="text" name="postal_code" value="{{old("postal_code",$user->postal_code)}}"
                                       class="form-control" id="postalCode">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="country">Country</label>
                                <select class="form-select" id="country" name="country" data-bs-size="5"
                                        aria-label="Select country">
                                    @foreach($options as $option)
                                        <option value="{{$option}}"
                                                @if($option == $user->country) selected @endif>{{$option}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="phoneNumber" class="form-label">Phone number</label>
                                <input type="text" class="form-control" name="phone_number"
                                       value="{{old("phone_number",$user->phone_number)}}" id="phoneNumber"
                                       placeholder="include international prefix e.g. +421">
                            </div>
                        </div>
                        @if(auth()->check())
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="hidden" name="save_address" value="0"/>
                                        <input name="save_address" class="form-check-input" type="checkbox" value="1"
                                               id="saveAddress" {{ old('save_address', isset($save_address) ? 'checked' : '') }}>
                                        <label class="form-check-label" for="saveAddress">
                                            I want to save this address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </section>
                    <!--    Payment-->
                    <section>
                        <div class="row">
                            <div class="col mt-2">
                                <h3 class="fs-4"> Payment </h3>
                                <div class="btn-group-vertical" role="group" aria-label="Payment radio group">
                                    @foreach($payments as $payment)
                                        <div class="form-check">
                                            @if($loop->first)
                                                <input class="form-check-input" type="radio" name="paymentGroup"
                                                       id="{{$payment->name}}"
                                                       value="{{$payment->name}}" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="paymentGroup"
                                                       id="{{$payment->name}}"
                                                       value="{{$payment->name}}">
                                            @endif
                                            <label class="form-check-label" for="{{$payment->name}}">
                                                {{$payment->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--    Shipping-->
                    <section>
                        <div class="row">
                            <div class="col mt-2">
                                <h3 class="fs-4">Shipping</h3>
                                <div class="btn-group-vertical" role="group" aria-label="Shipping radio group">
                                    @foreach($shippings as $shipping)
                                        @if ($loop->first)
                                            @include('components.checkout-checkbox', ['label' => $shipping->name, 'price' => $shipping->price, 'checked' => 'checked'])
                                        @else
                                            @include('components.checkout-checkbox', ['label' => $shipping->name, 'price' => $shipping->price])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--    Continue-->
                    <button type="submit" class="btn btn-blue my-3 fs-4">Continue to Review</button>
                </form>
            </div>
            <!--    Summary-->
            <div class="col-lg-6 order-1 order-lg-2">
                <section>
                    <h2 class="d-none d-lg-block fs-4">Summary</h2>
                    <div class="mod-collapse">
                        <div class="d-lg-none">
                            <div class="clearfix">
                                <a class="btn btn-blue w-100" role="button"
                                   data-bs-toggle="collapse" href="#summaryCollapse" aria-expanded="false"
                                   aria-controls="summaryCollapse">
                                    <div class="align-left"> Summary &nbsp;<i class="fas fa-chevron-down"></i></div>
                                    <div class="align-right total-price"><!--Javascript doplnene--></div>
                                </a>
                            </div>
                        </div>

                        <div class="collapse darkRectangle mt-2 p-3" id="summaryCollapse">
                            <div class="container">
                                <!--    Items-->
                            @foreach($products as $product)
                                @include("components.summary-item", ["product" => $product])
                            @endforeach

                            <!--    Subtotal-->
                                <div class="row border-bottom">
                                    <div class="col">
                                        <div class="py-2"> Subtotal</div>
                                        <div class="py-2"> Shipping</div>
                                    </div>
                                    <div class="col">
                                        <div class="text-end py-2">@money($totalPrice)</div>
                                        <div class="text-end py-2 shipping-price"><!--Javascript doplnene--></div>
                                    </div>
                                </div>
                                <!--    Total-->
                                <div class="row">
                                    <div class="col">
                                        <div class="pt-3 fs-4"> Total</div>
                                    </div>
                                    <div class="col">
                                        <div class="text-end pt-3 fw-bold fs-4 total-price">
                                            <!--Javascript doplnene--></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@push("scripts")
    <script>
        const updateShippingMethod = (shippingPrice, prevPrice) => {
            const totalPrice = (shippingPrice + prevPrice).toFixed(2);
            const totalPriceSelector = $(".total-price");
            totalPriceSelector[0].innerHTML = `$${totalPrice}`;
            totalPriceSelector[1].innerHTML = `$${totalPrice}`;
            const shippingPriceSelector = $(".shipping-price");
            shippingPriceSelector[0].innerHTML = `$${shippingPrice}`;
        }
        updateShippingMethod(2.99, {{$totalPrice}});

    </script>
@endpush
