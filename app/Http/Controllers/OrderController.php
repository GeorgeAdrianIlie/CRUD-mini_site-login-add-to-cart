<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderPart;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(){
        $loggedUser = Auth::user();
        if($loggedUser->role == "CUSTOMER"){
            $orders = Order::where('status',  '!=', 'DRAFT')->where('user_id', $loggedUser->id)->with('user')->get();
        }else{
            $orders = Order::where('status', '!=', 'DRAFT')->with('user')->get();
        }

        return view('orders.index', compact('orders'));
    }

    public function show($id){
        $order = Order::where('id', $id)->with('user')->with('orderParts')->first();
        
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $order = Order::find($id);

        $order->update($data);
        return redirect()->back();
    }


    public function addOrderPart(Request $request){
        $loggedUser = Auth::user();

        $data = $request->all();

        // verificam in oder daca exista deja order pentru user-ul logat
        // si oder-ul are statusul DRAFT
        $order = Order::where("user_id", $loggedUser->id)->where("status", "DRAFT")->first();

        if(!$order){

            // create order
            $order = Order::create([
                'user_id' => $loggedUser->id,
                'status' => 'DRAFT'
            ]);

        }

        // cautam produsul dupa $data['productId']

        $product = Product::where('id', $data['productId'])->first();

        // order parts
        OrderPart::create([
            'order_id' => $order->id,
            'subtotal' => $product->price*$data['quantity'],
            'product_price' => $product->price,
            'quantity' => $data['quantity'],
            'name' => $product->name
        ]);

        return redirect()->back();
    }

    public function cart(){

        $loggedUser = Auth::user();
        $order = Order::where("user_id", $loggedUser->id)
            ->where("status", "DRAFT")
            ->with('orderParts')
            ->first();

        return view('cart.index', compact('order', 'loggedUser'));
    }


    public function removeOrderPart(Request $request){
        $data = $request->all();

        $orderPart = OrderPart::where("id", $data['part_id'])->first();
        if ($orderPart){
            $orderPart->delete();
        }
        return redirect()->route('cart');
    }

    public function placeOrder(Request $request){
        $request->validate([
            'delivery_date' => 'required',
        ]);
        $data = $request->all();

        $total = 0;

        $order = Order::where('id', $data["order_id"])->where('status', 'DRAFT')->with('orderParts')->first();

        if($order) {

            foreach ($order->orderParts as $part){
                $total += $part->subtotal;
            }

            $order->total_price = $total;
            $order->status = "NEW";
            $order->delivery_address = $data["delivery_address"];
            $order->invoice_address = $data["invoice_address"];
            $order->delivery_date = $data["delivery_date"];

            $order->save();

            return redirect()->route('orders.index');

        }

        return redirect()->back();

    }

}
