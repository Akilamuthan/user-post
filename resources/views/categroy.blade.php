@extends('layouts.app')

@section('content')
    <button class="btn btn-outline-info" onclick="menu()">Menu</button>

    <div class="col-3" id="search">
        <form action="{{ route('search') }}" method="get">
            <div class="input-group mb-1">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" name="content" required>
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </div>

    <div class="container mt-4" style="width: 800px; height: 500px;" id="items">
        <div class="row">

            @foreach($prodect as $product)

                <div class="col-12 col-sm-6 col-md-4 mb-3" id="prodect">

                    <div class="card bg-light hover-card" style="height: 400px;">
                        <img src="{{ asset('images/' . $product->image) }}" class="img-thumbnail" alt="Product Image" style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body text-dark d-flex flex-column" style="flex-grow: 1;">

                            <div class="d-flex flex-column justify-content-between" style="flex-grow: 1;">

                                <p class="card-title" style="font-size:13px;">{{ $product->content }}</p>

                                <p class="card-text" style="font-size:13px;"><strong>Category:</strong> {{ $product->category }}</p>

                            </div><br>

                            <a href="{{ route('product', $product->id) }}" class="mt-auto">
                                
                                <button class="btn btn-outline-primary">{{ $product->payment }}</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
