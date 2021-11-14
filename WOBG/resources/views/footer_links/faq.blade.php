@extends("layout.app")
@section('title', 'WOBG - FAQ')
@section("content")
    <main class="container pt-5 pb-5">
        <h1 class="text-center fw-bold"> Frequently Asked Questions </h1>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                        I want to return my product.
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                     aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        We provide exchange or refund according to following conditions:
                        <ul>
                            <li> The product is in its original package and unused</li>
                            <li> The request for return is made within 30 days from the date of purchase</li>
                            <li> Return postage is covered by the customer</li>
                        </ul>
                        Please <a href="{{url("contacts")}}" class="black-link">contact us</a> for more information
                        about return
                        policy, as this can vary from case to case.

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                        Can I cancel my order?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                     aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        We cannot guarantee it will be possible to cancel your order, since the process begins
                        immediately
                        after the order is placed. Please <a href="{{url("contacts")}}"> <u>contact us</u> </a> as soon
                        as you
                        wish to cancel your order and include
                        your order number and cancellation details.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                        When will I receive my order?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                     aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        We start to proceed the order immediately after it has been placed. Once your order is ready,
                        it's
                        collected by our couriers, and it's their responsibility to deliver the package to you safely.
                        Our
                        deliveries are fully tracked with your tracking number included in shipping confirmation email.
                        For more information about delivery and shipping, please visit
                        <a href="{{url("delivery-shipping")}}" class="black-link"> Delivery & Shipping</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
