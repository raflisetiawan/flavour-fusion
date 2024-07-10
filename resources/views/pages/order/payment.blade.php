@extends('layouts.customer')

@section('title', 'Payment')

@section('content')
    <section class="contentku payment">
        <div class="container">
            <h2 class="color-f">Payment Details</h2>
            <div class="order-details">
                <h3 class="color-f">Order ID: {{ $order->id }}</h3>
                <p class="color-f">Total Amount: {{ $order->total_amount }}</p>
            </div>
            <form action="{{ route('order.processPayment', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="color-f" for="amount">Amount:</label>
                    <input readonly type="number" class="form-control" id="amount" name="amount" value="{{ $order->total_amount }}" min="{{ $order->total_amount }}" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label class="color-f" for="payment_method">Select Payment Method:</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="" selected disabled>Choose...</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn bg-color text-white" type="submit">Pay Now</button>
            </form>
        </div>
    </section>
@endsection
