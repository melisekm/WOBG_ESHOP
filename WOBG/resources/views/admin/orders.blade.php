@extends("layout.partials.admin")
@section('title', "Admin dashboard: Orders")
@section("admin-content")
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h2>Orders</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model_collection as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>@if($order->user){{ $order->user->first_name }} {{$order->user->surname}}@else
                                        Guest @endif</td>
                                <td>@money($order->total)</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('components.product-catalog.pagination', ['paginator' => $model_collection])

    </div>
@endsection
