<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $availability_state = 0;
        $products = Product::with("category");
        if($request->has('availability')) {
           if($data['availability'] == 'on'){
                $products->where('availability', 1);
                $availability_state = 1;  
           }
        }
        $products = $products->get();
        return view('products.index', compact('products', 'availability_state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'meta_description' => 'required',
            'description'   => 'required',
            'price' => 'required',
            'VAT' => 'required',
            'availability' => 'required',
            'category_id' => 'required',
            'tag' => 'required',
            'image' => 'required',
        ]);

        $data = $request->all();

        $product = new Product;
        $product->name = $data["name"];
        $product->meta_description = $data["meta_description"];
        $product->price = $data["price"];
        $product->VAT = $data["VAT"];
        $product->availability = $data["availability"];
        $product->description = $data["description"];
        $product->category_id = $data["category_id"];
        $product->tag = $data["tag"];

        if($data['image']) {
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = $product->name. "-" . time() . "." . $extension;
            $file->move('products/uploads/', $filename);
            $product->image = $filename;
        }

        $product->save();

        return redirect()->route("product.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::get();

        return view('products.edit', compact('product', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
    
        $product->name = $data["name"];
        $product->meta_description = $data["meta_description"];
        $product->price = $data["price"];
        $product->VAT = $data["VAT"];
        $product->availability = $data["availability"];
        $product->description = $data["description"];
        $product->category_id = $data["category_id"];
        $product->tag = $data["tag"];

        if( isset($data['image']) && $data['image']) {

            $image_path = public_path("/products/uploads/". $product->image);
            
            if(\File::exists($image_path)) {
                \File::delete($image_path);
            }

            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = $product->name. "-" . time() . "." . $extension;
            $file->move('products/uploads/', $filename);
            $product->image = $filename;
        }

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            $product->delete();
            return redirect()->route("product.index");
        }

    }
}
