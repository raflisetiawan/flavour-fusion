@extends('layouts.kedai')

@section('content')
<div class="container">
    <h1 class="mt-4">Orders for Menu: {{ $menu->name }}</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Orders List
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order->customer->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->subtotal }}</td>
                        <td>{{ $order->order->order_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('pemilikKedai.menu.index') }}" class="btn btn-secondary">Back to Menu List</a>
</div>
@endsection
