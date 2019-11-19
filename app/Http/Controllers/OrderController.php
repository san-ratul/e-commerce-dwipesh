<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Cart;

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

    public function addCart(Request $request,Product $product)
    {
        $this->validate($request,[
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);

        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'size' => ($request->size != null)?$request->size: null,
                'color' => ($request->size != null)?$request->color: null,
            )
        ));
        return redirect()->back()->with('success','product added to cart');
    }
    public function updateCart(Request $request,Medicine $medicine)
    {
        $this->validate($request,[
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);
        Cart::update($medicine->id,array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ));
        return redirect()->back()->with('success','Cart Updated!');
    }

    public function destroyCart(Request $request,Medicine $medicine)
    {
        Cart::remove($medicine->id);
        return redirect()->back()->with('success','Cart Updated!');
    }
    public function showCart()
    {
        // $cart['count'] = Cart::getContent()->count();
        // $medicines = new Collection();
        // $cart_items = Cart::getContent();
        // $cart['subTotal'] = Cart::getSubTotal();
        // foreach($cart_items as $item){
        //     $medicine = Medicine::find($item->id);
        //     $medicine->quantity = $item->quantity;
        //     $medicine->subTotal = $item->getPriceSum();
        //     $medicines->push($medicine);
        // }
        // $cart['shops'] = $medicines->unique('shop')->count();
        // return view('cart.index',compact('medicines','cart'));

        $cart['count'] = Cart::getContent()->count();
        return $cart_items = Cart::getContent();
    }
}
