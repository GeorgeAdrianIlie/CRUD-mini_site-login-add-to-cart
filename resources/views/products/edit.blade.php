@extends('layouts.app')

@section('content')

<div class="row">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-3"> </div>

    <div class="col-6">

        <div class="card">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center mt-2">
                    <img src="{{ asset('products/uploads/' . $product->image) }}" alt=".."
                        style="width: 10rem; border-radius: 50%;">
                </div>
            </div>
            <form action="{{ route('product.update', $product->id ) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name" class="ml-4 mt-3">Name</label>
                    <input name="name" class="form-control ml-3 mr-3 w-75" type="text" value="{{ $product->name }}">
                </div>

                <div class="form-group">
                    <label for="meta_description" class="ml-4 mt-3">Meta_description</label>
                    <input name="meta_description" class="form-control ml-3 mr-3 w-75" type="text"
                        value="{{ $product->meta_description }}">
                </div>

                <div class="form-group">
                    <label for="price" class="ml-4 mt-3">Price</label>
                    <input name="price" class="form-control ml-3 mr-3 w-75" type="number"
                        value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label for="VAT" class="ml-4 mt-3">VAT</label>
                    <input name="VAT" class="form-control ml-3 mr-3 w-75" type="number" value="{{ $product->VAT }}">
                </div>

                <div class="form-group">
                    <label for="availability" class="ml-4 mt-3">Availability</label>
                    <select name="availability" class="form-control ml-3 mr-3 w-75" id="availability">
                        <option value="">---Selectati---</option>
                        <option @if($product->availability == 1) selected @endif value="1" >Active</option>
                        <option @if($product->availability == 0) selected @endif value="0" >Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description" class="ml-4 mt-3">Description</label>
                    <textarea name="description" class="form-control ml-3 mr-3 w-75"
                        type="text">{{ $product->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_id" class="ml-4 mt-3">Category</label>
                    <select name="category_id" class="form-control ml-3 mr-3 w-75" id="category_id">
                        <option value="">---Selectati---</option>
                        @foreach($categories as $category)
                            <option @if( $category->id == $product->category_id) selected @endif
                                value="{{ $category->id }}" >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image" class="ml-4 mt-3">Image</label>
                    <input name="image" class="form-control ml-3 mr-3 w-75" type="file">
                </div>

                <div class="form-group">
                    <label for="tag" class="ml-4 mt-3">TAG</label>
                    <input name="tag" class="form-control ml-3 mr-3 w-75" type="text" value="{{ $product->tag }}">
                </div>

                <button type="submit" class="btn btn-success ml-3 w-20">Submit</button>
                <a href="{{ route("product.index") }}"
                    class="btn btn-danger ml-3 mr-3 w-20">Cancel</a>

            </form>
        </div>
    </div>

    <div class="col-3"></div>
</div>
@endsection
