<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function addCart(Request $request, Product $product)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);

        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'size' => ($request->size != null) ? $request->size : null,
                'color' => ($request->size != null) ? $request->color : null,
            )
        ));
        return redirect()->back()->with('success', 'product added to cart');
    }
    public function updateCart(Request $request, Product $product)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);
        Cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ));
        return redirect()->back()->with('success', 'Cart Updated!');
    }

    public function destroyCart(Request $request, Product $product)
    {
        Cart::remove($product->id);
        return redirect()->back()->with('success', 'Cart Updated!');
    }
    public function showCart()
    {
        $cart['count'] = Cart::getContent()->count();
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->subTotal = $item->getPriceSum();
            $products->push($product);
        }
        return view('order.cart', compact('products', 'cart'));
    }
    public function userCheckout($lat, $lon)
    {
        $cart['count'] = Cart::getContent()->count();
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->subTotal = $item->getPriceSum();
            $products->push($product);
        }
        if($lat != 'na' || $lon != 'na'){
            $query = $lat . ',' . $lon;
            $geocoder = new \OpenCage\Geocoder\Geocoder('83d88a1f9eac460bb380ab54bb477a28');
            $result = $geocoder->geocode($query); # latitude,longitude (y,x)
            $location = $result['results'][0]['formatted'];
        }else{
            $location = '';
        }

        return view('order.checkout', compact('products', 'cart', 'location'));
    }
}
