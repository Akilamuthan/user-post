@extends('layouts.app')

@section('content')
@if(session('message'))
<p class="alert alert-success">{{ session('message') }}</p>
@endif
<div class="container mt-5">
    <h2>Purchase Form</h2>
    <form id="purchase-form" class="form-inline" action="{{ route('productpayment', $product->id) }}" method="get">
        @csrf  <!-- Add CSRF token for security -->

        <div class="form-group mr-2">
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>

            <input type="text" name="card_name" class="form-control" placeholder="Name on card" required>

            <input type="text" name="card_number" class="form-control" placeholder="Card Number" required>

            <input type="text" name="cvc" class="form-control" placeholder="CVC" required>

            <input type="text" name="exp_month" class="form-control" placeholder="Expiration Month" required>

            <input type="text" name="exp_year" class="form-control" placeholder="Expiration Year" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Buy</button>
    </form>
</div>

<p></p>
@endsection
