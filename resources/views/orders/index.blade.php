@extends('layouts.app')

@section('content')

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th scope="col">Status</th>
            <th scope="col">Total</th>
            <th scope="col">Delivery Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
          <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->total_price}}</td>
            <td>{{$order->delivery_date}}</td>
            <td>
                <a href='{{route('orders.show', $order->id)}}' class="btn btn-info" >Details</a>
            </td>

          </tr>
          @endforeach
        </tbody>
    </table>


@endsection