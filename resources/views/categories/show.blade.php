@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="row">
        @foreach ($category->products as $product)
            @include('products.listingItem', ['product' => $product])

         @endforeach
        </div>      
    </div>
</div>



@endsection