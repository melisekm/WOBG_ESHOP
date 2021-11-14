@extends("layout.app")
@section('title', 'WOBG - Delivery and Shipping')
@section("content")
    <main class="container pt-5 pb-5">
        <h1 class="text-center fw-bold"> Delivery & Shipping </h1>
        <h2 class="text-center fw-bold"> Worldwide Delivery </h2>
        <table class="table ">
            <thead>
            <tr>
                <th scope="col">Type of Delivery</th>
                <th scope="col">Price</th>
                <th scope="col">Europe</th>
                <th scope="col">Rest of the world</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Standard Delivery</td>
                <td>2.99$</td>
                <td>5-11 Business Days</td>
                <td>7-20 Business Days</td>
            </tr>
            <tr>
                <td>UPS Service</td>
                <td>5.49$</td>
                <td>2-7 Business Days</td>
                <td>5-15 Business Days</td>
            </tr>
            <tr>
                <td>Parcel Service</td>
                <td>4.99$</td>
                <td>3-6 Business Days</td>
                <td>6-16 Business Days</td>
            </tr>
            </tbody>

        </table>
        <h2 class="text-center fw-bold"> Shipping Details </h2>
        <p>We start to proceed orders immediately after they have been placed. Delay may occur occasionally due to
            circumstances outside WOBG. After placing the order, you will receive Shipping Confirmation e-mail with shipping
            details and tracking number. If you believe there has been an issue with your delivery, please <a
                href="{{url("contacts")}}" class="black-link"> contact us.</a> Import/customs/inspection charges may apply and
            are the
            sole responsibility of the customer, including in the event of a refusal of delivery. Please refer to your
            country's relevant Customs and Import Polices prior to purchase. </p>
    </main>
@endsection
