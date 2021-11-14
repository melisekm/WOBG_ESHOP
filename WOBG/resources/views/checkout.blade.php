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

        <div class="row my-3">
            <!--    Info-->
            <div class="col-lg-6 mt-lg-0 mt-3 order-2 order-lg-1">
                <section>
                    <h2 class="fs-4 mb-2">Billing information</h2>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName">
                        </div>
                        <div class="col mb-3">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="surname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="street" class="form-label">Street</label>
                            <textarea class="form-control" id="street" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city">
                        </div>
                        <div class="col mb-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="country">Country</label>
                            <select class="form-select " id="country" name="country" data-bs-size="5"
                                    aria-label="Select country">
                                <!--source: https://www.technicalkeeda.com/html-tutorials/all-countries-drop-down-list-in-html -->
                                <option value="Slovakia">Slovakia</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Hungary">Hungary</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="phoneNumber" class="form-label">Phone number</label>
                            <input type="text" class="form-control" id="phoneNumber"
                                   placeholder="include international prefix e.g. +421">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="saveAddress">
                                <label class="form-check-label" for="saveAddress">
                                    I want to save this address
                                </label>
                            </div>
                        </div>
                    </div>
                </section>
                <!--    Payment-->
                <section>
                    <div class="row">
                        <div class="col 4 mt-2">
                            <h3 class="fs-4"> Payment </h3>
                            <div class="btn-group-vertical" role="group" aria-label="Payment radio group">

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentRadios" id="paymentPaypal"
                                           value="paymentPaypal" checked>
                                    <label class="form-check-label" for="paymentPaypal">
                                        Paypal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentRadios"
                                           id="paymentBankTransfer"
                                           value="paymentBankTransfer">
                                    <label class="form-check-label" for="paymentBankTransfer">
                                        Bank Transfer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentRadios" id="paymentCard"
                                           value="paymentCard">
                                    <label class="form-check-label" for="paymentCard">
                                        Card
                                    </label>
                                </div>
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
                                <div class="row">
                                    <div class="col-6 col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shippingRadios"
                                                   id="shippingStandard"
                                                   value="shippingStandard" checked>
                                            <label class="form-check-label" for="shippingStandard">
                                                Standard Delivery
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        2.99$
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shippingRadios"
                                                   id="shippingUPS"
                                                   value="shippingUPS">
                                            <label class="form-check-label" for="shippingUPS">
                                                UPS Service
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        5.49$
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shippingRadios"
                                                   id="shippingParcel"
                                                   value="shippingParcel">
                                            <label class="form-check-label" for="shippingParcel">
                                                Parcel Service
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        4.99$
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--    Continue-->
                <a class="btn btn-blue my-3 fs-4" href="{{url("review")}}">Continue to Review</a>
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
                                    <div class="align-right"> 202.95$</div>
                                </a>
                            </div>
                        </div>

                        <div class="collapse darkRectangle mt-2 p-3" id="summaryCollapse">
                            <div class="container">
                                <!--    Items-->
                                @include("components.summary-item")
                                @include("components.summary-item")
                                @include("components.summary-item")

                                <!--    Subtotal-->
                                <div class="row border-bottom">
                                    <div class="col">
                                        <div class="py-2"> Subtotal</div>
                                        <div class="py-2"> Shipping</div>
                                    </div>
                                    <div class="col">
                                        <div class="text-end py-2">199.96$</div>
                                        <div class="text-end py-2">2.99$</div>
                                    </div>
                                </div>
                                <!--    Total-->
                                <div class="row">
                                    <div class="col">
                                        <div class="pt-3 fs-4"> Total</div>
                                    </div>
                                    <div class="col">
                                        <div class="text-end pt-3 fw-bold fs-4">202.95$</div>
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
