@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
               @foreach($report as $item) 
                 @if ($item->user== Auth::user()->name)
                    <tr>
                       <td>{{ $item->user }}</td>
                       <td>{{ $item->prodect }}</td>
                       <td>{{ $item->payment }}</td> 
                 </tr>
                 @endif   
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
