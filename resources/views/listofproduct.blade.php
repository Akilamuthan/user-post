@extends('adminwebpage')

@section('prodect')
    <div class="container mt-4">
        <h2 class="mb-4">Product List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th>List</th>
                    <th>Category</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->image}}></td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->list }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->payment }}</td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
