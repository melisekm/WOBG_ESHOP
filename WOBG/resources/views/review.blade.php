@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/checkout.css")}}">
@endpush
@section('title', 'WOBG - Review')
@section("content")
    <main class="container">
        <ul class="timeline mt-4 ">
            <li class="step complete">
                <div class="status">
                    <div><a href="{{url("checkout")}}" class="black-link">Information</a></div>
                </div>
            </li>
            <li class="step complete">
                <div class="status">
                    <div><a href="#" class="black-link">Review</a></div>
                </div>
            </li>
            <li class="step">
                <div class="status">
                    <div> Payment</div>
                </div>
            </li>
            <li class="step">
                <div class="status">
                    <div> Done</div>
                </div>
            </li>
        </ul>

        <h1 class="my-3 display-6">Review</h1>
        <div class="row my-3">
            <div class="col-lg-6 mt-lg-0 mt-3 order-2 order-lg-1">
                <div class="form-group">
                    <label for="TextareaAddress" class="fs-4 form-label mt-md-0 mt-3">Address</label>
                    <textarea disabled class="form-control rounded-2" id="TextareaAddress" rows="7">
John Smith
2978 Main St
MN 23876
US
smith.john@gmail.com
+4216505130514
                        </textarea>
                </div>
                <!--    Payment-->
                <div class="row">
                    <div class="col 4 mt-2">
                        <div class="fs-4">
                            Payment
                        </div>
                        <div class="btn-group-vertical" role="group" aria-label="Payment radio group">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentRadios" id="paymentPaypal"
                                       value="paymentPaypal" checked>
                                <label class="form-check-label" for="paymentPaypal">
                                    Paypal
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    Shipping-->
                <div class="row">
                    <div class="col mt-2">
                        <div class="fs-4"> Shipping</div>
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
                        </div>
                    </div>
                </div>
                <!--    Continue or back-->
                <div class="row">
                    <div class="col">
                        <a class="btn btn-blue my-3 fs-4" href="{{url("order-completed")}}">Pay now</a>
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-secondary my-3 fs-4" href="{{url("checkout")}}">Back</a>
                    </div>
                </div>
            </div>
            <!--    Summary-->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="d-none d-lg-block fs-4">Summary</div>
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
            </div>
        </div>
    </main>
@endsection
