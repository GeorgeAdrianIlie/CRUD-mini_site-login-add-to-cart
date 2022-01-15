@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-3">

      </div>
        <div class="col-6">
          <div class="row">
            <label>User Name: {{ $order->user->name }}</label>
          </div>
          @if(Auth::user() && Auth::user()->role == "ADMIN")
          <form action="{{ route('orders.update', $order->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <label>Inoice Address: </label>
              <input type="text" class="form-control" name="delivery_address" value="{{$order->invoice_address }}">
            </div>
            <div class="row">
              <label>Delivery Address:</label>
              <input type="text" class="form-control"  name="delivery_address" value="{{ $order->delivery_address }}">
            </div>
          <div class="row">
            <label>Delivery Date:</label>
            <input type="date" class="form-control"  name="delivery_date" value="{{$order->delivery_date }}">
          </div>
          <div class="row">
            <label for="status">Status: </label>
            <select name="status" id="status" class="form-control" >
              <option @if($order->status == 'NEW') selected @endif value="NEW">
                NEW
              </option>
              <option @if($order->status == 'SENT') selected @endif value="SENT">
                SENT
              </option>
              <option @if($order->status == 'DELIVERED') selected @endif value="DELIVERED">
                DELIVERED
              </option>
            </select>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-success mt-3">Save</button>
          </div>
          </form>
          @else
            <div class="row">
              <label>Inoice Address: {{$order->invoice_address }}</label>
            </div>
            <div class="row">
              <label>Delivery Address:{{ $order->delivery_address }}</label>
            </div>
          <div class="row">
            <label>Delivery Date: {{$order->delivery_date }}</label>
          </div>
          <div class="row">
            <label for="status">Status: {{ $order->status}} </label>
          </div>
          
          @endif


          <table class="table mt-3">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
                @foreach($order->orderParts as $part)
              <tr>
                <td>{{$part->id}}</td>
                <td>{{$part->name}}</td>
                <td>{{$part->product_price}}</td>
                <td>{{$part->quantity}}</td>
                <td>{{$part->subtotal}}</td>
        
              </tr>
              @endforeach
            </tbody>
        </table>
        <div class="row">
          <h3>Total to pay: {{$order->total_price}} RON</h3>
        </div>
        </div>
      <div class="col-3">
        
      </div>
    </div>
  </div>
</div>

 

@endsection