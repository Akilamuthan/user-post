@extends('adminwebpage')

@section('prodect')
<form action="{{route('prodect')}}" method="post" class="container mt-4" enctype="multipart/form-data">
    @csrf <!-- Don't forget to include this for CSRF protection -->
    <div class="mb-3">
        <label for="image" class="form-label">Image URL</label>
        <input type="file" name="image" class="form-control" id="image" placeholder="Enter image URL" required>
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <input type="text" name="content" class="form-control" id="content" placeholder="Enter content" required>
        @error('content')
            <div class="invalid feedback">{{$message}}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="list" class="form-label">List</label>
        <input type="text" name="list" class="form-control" id="list" placeholder="Enter list" required>
        @error('list')
        <div class="invalid feedback">{{$message}}</div>
    @enderror
    </div>
    
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" name="category" class="form-control" id="category" placeholder="Enter category" required>
        @error('category')
        <div class="invalid feedback">{{$message}}</div>
    @enderror
    </div>
    
    <div class="mb-3">
        <label for="book " class="form-label">book download</label>
        <input type="file" name="book" class="form-control" id="book" placeholder="Enter book" required     >
        @error('book')
        <div class="invalid feedback">{{$message}}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="offer" class="form-label">Offer</label>
        <input type="text" name="offer" class="form-control" id="offer" placeholder="Offer">
        @error('offer')
        <div class="invalid feedback">{{$message}}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="payment" class="form-label">Payment Method</label>
        <input type="text" name="payment" class="form-control" id="payment" placeholder="Enter payment method">
        @error('payment')
        <div class="invalid feedback">{{$message}}</div>
    @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
