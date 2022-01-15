@extends('layouts.app')

@section('content')

@if(Auth::user() && Auth::user()->role == "ADMIN")
<div class="mb-5 ">
    <a class="btn btn-success" href="{{route("product.create");}}">
        CREATE NEW
    </a>
</div>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Meta_description</th>
            <th scope="col">Price</th>
            <th scope="col">VAT</th>
            <th scope="col">Availability</th>
            <th scope="col">Description</th>
            <th scope="col">Category_id</th>
            <th scope="col">Image</th>
            <th scope="col">Tag</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
          <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->meta_description}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->VAT}}</td>
            <td>{{$product->availability ? "Active" : "Inactiv"}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->category->name}}</td>
            <td><img src="{{ asset('products/uploads/' . $product->image) }}" alt="..." style="width: 50px; border-radius: 50%;" ></td>
            <td>{{$product->tag}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('product.edit', $product->id);}}" >EDIT</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal{{$product->id}}">
                    DELETE
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="deleteProductModal{{$product->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Delete product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to do that ?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        <form action="{{route('product.destroy', $product->id);}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-primary" >YES</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
@endif

@if(Auth::user() && Auth::user()->role == "CUSTOMER")
    
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    {{-- check availability --}}
                    <form action="{{route('product.index')}}" method="GET">
                        <input type="checkbox" name="availability" {{ $availability_state == 1 ? 'checked' : ""}} onChange="this.form.submit()" ><label>Availability</label>
                    </form>
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                @foreach ($products as $product)
                                    @include('products.listingItem', ['product' => $product])

                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>

@endif



@endsection