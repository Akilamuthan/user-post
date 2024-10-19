@extends('layouts.app')

@section('content')
<center>
    <div class="container mt-6">
        <div class="row" style="max-width: 400px;"> <!-- Increased max-width -->
            <div class="col-12 mb-3">
                <div class="card" style="height: 600px;"> <!-- Set a specific height -->
                    <img src="{{ asset('images/' . $prodect->image) }}" class="card-img-top" alt="Product Image" style="width: 100%; height: auto;">
                    <div class="card-body" style="padding: 20px;"> <!-- Added padding -->
                        <h5 class="card-title">{{ $prodect->content }}</h5>
                        <p class="card-text"><strong>Category:</strong> {{ $prodect->category }}</p>
                        <a href="/paymented"><button class="btn btn-primary">{{ $prodect->payment }}</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</center>

@endsection