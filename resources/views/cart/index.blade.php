@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
        <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </ul>
</div>
@endif

@if($order)
    <form action="{{route('placeOrder')}}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{$order->id}}">
        <div class="row mb-4" style="justify-content: space-evenly;">
            <div class="card">
                <div class="card-body">
                Time of delivery 
                <input class="form-control" type="date" name="delivery_date">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Delivery Address:</br>
                    <span class="mt-2 mb-2" id="delivery-address">{{ $loggedUser->address }}</span>
                    <div class="col-12 pl-0">
                        <input class="d-none form-control mb-2" type="text" name="delivery_address" id="i-delivery-address" value="{{ $loggedUser->address }}">
                    </div>
                    <button class="btn btn-sm btn-info" onclick="changeAddress();" id="change-delivery-address">Change address</button>
                    <button class="d-none btn btn-sm btn-primary" onclick="saveAddress();" id="save-delivery-address">Save</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Invoice Address:</br>
                    <span class="mt-2 mb-2" id="invoice-address">{{ $loggedUser->address }}</span>
                    <div class="col-12 pl-0">
                        <input class="d-none form-control mb-2" type="text" name="invoice_address" id="i-invoice-address" value="{{ $loggedUser->address }}">
                    </div>
                    <button class="btn btn-sm btn-info" onclick="changeInvoiceAddress();" id="change-invoice-address">Change address</button>
                    <button class="d-none btn btn-sm btn-primary" onclick="saveInvoiceAddress();" id="save-invoice-address">Save</button>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <td>
                        product name
                    </td>
                    <td>
                        quantity
                    </td>
                    <td>
                        unit price
                    </td>
                    <td>
                    subtotal
                    </td>
                    <td>
                        Action
                    </td>
                </tr>   
            </thead>
            <tbody>
                @foreach($order->orderParts as $part)
                <tr>
                    <td>
                        {{$part->name}}
                    </td>
                    <td>
                        {{$part->quantity}}
                    </td>
                    <td>
                        {{$part->product_price}}
                    </td>
                    <td>
                        {{$part->subtotal}}
                    </td>
                    <td>
                        <form action="{{route('removeOrderPart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="part_id" value="{{$part->id}}">
                            <button type="submit" class="btn">
                                <i class="fas fa-times-circle" style="color: red"></i>
                            </button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            </tbody>

        </table>

        <div class="row justify-content-center align-items-center mb-3">
            <input type='checkbox' class="mr-2" id="toggle"> Sunt de acord cu "Termenii si conditiile"
        </div>
        <div class="row justify-content-center align-items-center">
                <button type="submit" class="btn btn-lg btn-light btn-outline-secondary" disabled id="place-order" style="color:aqua">Plaseaza comanda</button>
        </div>
    </form> 
@else
<h1>No products in cart !</h1>    
@endif

@endsection