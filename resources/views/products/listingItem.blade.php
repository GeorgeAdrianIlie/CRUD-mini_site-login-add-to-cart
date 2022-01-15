<div class="col-3 mb-3">
    <div class="card">
        <img src="{{ asset('products/uploads/' . $product->image) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">{{$product->meta_description}}</p>
            <form action="/add-order-item" method="post">
                @csrf
                <div class="d-flex">
                    <button onclick="subtractQuantity({{$product->id}});" type="button">-</button>
                    <input type="number" class="w-25" name="quantity" value="0" id="quantity-{{$product->id}}">
                    <button onclick="addQuantity({{$product->id}});" type="button">+</button>
                </div>
                <input type="hidden" value="{{$product->id}}" name="productId">
                <button type="submit" class="btn btn-primary">Add to cart</button>
            </form>
        </div>
    </div>
</div>