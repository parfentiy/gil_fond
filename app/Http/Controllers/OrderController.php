<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index() {
        $myOrders = Order::where('user_id', Auth::user()->id)->get();
        $orderDetails = [];
        $finally_amount = 0;

        foreach ($myOrders as $myOrder) {
            $productsList = "";
            foreach (OrderProduct::where('order_id', $myOrder->id)->get() as $orderProduct) {
                $productsList .= Product::find($orderProduct->product_id)->name . ", ";
            }
            $productsList = rtrim($productsList,', ');

            $orderDetails[] = [
                'order_id' => $myOrder['id'],
                'total_amount' => $myOrder['total_amount'],
                'date' => $myOrder['updated_at'],
                'products' => $productsList,
            ];

            $finally_amount += $myOrder['total_amount'];
        }

        return view('orders_list')->with([
            'detailedOrders' => $orderDetails,
            'finally_amount' => $finally_amount,
        ]);
    }

    public function add(Request $request) {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        $orderNumber = Order::create([
            'user_id' => Auth::user()->id,
            'total_amount' =>$request->total_amount,
        ])->id;

        foreach ($cartItems as $cartItem) {
            OrderProduct::create([
                'order_id' => $orderNumber,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'price' => Product::find($cartItem['product_id'])->price,
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        return view('order_added_successfully')->with(['orderNumber' => $orderNumber]);
    }

    public function delete(Request $request) {
        OrderProduct::where('order_id', $request->order_id)->delete();
        Order::find($request->order_id)->delete();

        return redirect()->back();

    }

}
