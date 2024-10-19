@extends('adminwebpage')

@section('prodect')
<div class="container mt-4">
    <h2 class="mb-4">Product Reports</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-light"> <!-- Changed to thead-light -->
            <tr>
                <th>User</th>
                <th>Product</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $item)
            <tr>
                <td>{{ $item->user }}</td>
                <td>{{ $item->prodect }}</td>
                <td>{{ $item->payment }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
