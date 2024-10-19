@extends('layouts.app')
@section('content')
    <!-- Product Section -->
    <div class="container my-5" id="product-details">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $productitem->image) }}" class="product-img img-fluid" alt="Product Image" style="  background-attachment: fixed;">
            </div>
            <div class="col-md-6">
                <h2>{{ $productitem->content }}</h2>

                @if( $productitem->offer=="0")
                             <p class="card-text" style="font-size:13px;"><strong>Price:</strong> {{$productitem->payment}}</p> 
                                
                            @else

                            <p class="card-text" style="font-size:13px; text-decoration: line-through;"><strong>Price:</strong> {{ $productitem->payment}}</p>

                            <p class="card-text" style="font-size:13px;"><strong>Offer:</strong> {{ $productitem->payment-$productitem->offer}}</p>

                            
                            @endif

                <p>{{ $productitem->description }}</p>
                <a href="{{route('paymentdetail',$productitem->id)}}"><button class="btn btn-primary btn-lg">Buy</button></a>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="container my-5" id="reviews">
        <h2>Customer Reviews</h2>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">John Doe</h5>
                <p class="card-text">Great product! Really satisfied with my purchase.</p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Jane Smith</h5>
                <p class="card-text">Excellent quality. Will definitely buy again!</p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Michael Johnson</h5>
                <p class="card-text">Fast shipping and the product works perfectly.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @endsection 

