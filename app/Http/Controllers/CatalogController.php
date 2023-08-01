<?php

namespace App\Http\Controllers;


class CatalogController extends Controller
{
    //
    public function index()
    {
        $session = session()->all();
        $cart = empty($session['products']) ? [] : $session['products'];

        return view('catalog', compact('cart'));
    }
}
