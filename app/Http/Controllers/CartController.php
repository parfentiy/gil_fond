<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function index() {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $cart = !empty($cart) ? $cart : [];

        return view('cart');
    }

    public function create(Request $request) {
        Cart::updateOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
        ],
        [
            'quantity' => $request->quantity,
        ]);

        return redirect()->back();
    }

    public function update(Request $request) {
        Cart::update([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    public function delete(Request $request) {
        Cart::where('user_id', Auth::user()->id)->where('product_id', $request['product_id'])->delete();

        return redirect()->back();
    }

    public function clear() {
        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect()->back();
    }
}
