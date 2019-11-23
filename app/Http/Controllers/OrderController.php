<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetails;
use App\Shipping;
use App\Product;
use App\ProductRating;
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
        $user = auth()->user();
        if (isset($request->others)) {
            $this->validate($request, [
                's_name' => ['required'],
                's_address_line_1' => ['required'],
                's_phone' => ['required'],
                'trx_id' => ['required', 'unique:orders'],
            ]);
        } else {
            $this->validate($request, [
                'address_line_1' => ['required'],
                'trx_id' => ['required', 'unique:orders'],
            ]);
        }
        // making ready productlist
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->subTotal = $item->getPriceSum();
            $product->color    = $item->attributes['color'];
            $product->size     = $item->attributes['size'];
            $products->push($product);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total'   => $cart['subTotal'],
            'trx_id'  => $request->trx_id,
            'paid'    => $cart['subTotal'],
            'note'    => $request->note ?? null,
            'status'  => 'Payment Verification Pending',
        ]);

        foreach ($products as $product) {
            OrderDetails::create([
                'order_id'    => $order->id,
                'product_id'  => $product->id,
                'seller_id'   => $product->seller_id,
                'quantity'    => $product->quantity,
                'color'       => $product->color,
                'size'        => $product->size,
            ]);
        }

        if (isset($request->others)) {
            Shipping::create([
                'order_id' => $order->id,
                's_name' => $request->s_name,
                's_phone' => $request->s_phone,
                's_address_line_1' => $request->s_address_line_1,
                's_address_line_2' => $request->s_address_line_2,
                'status' => 'Order Placed',
            ]);
        } else {
            Shipping::create([
                'order_id' => $order->id,
                's_name' => $user->name,
                's_phone' => $user->phone,
                's_address_line_1' => $request->address_line_1,
                's_address_line_2' => $request->address_line_2,
                'status' => 'Order Placed',
            ]);
        }
        return redirect()->route('home')->with('status', 'Order Placed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showDetails(Order $order)
    {
        if (auth()->user()->id == $order->user->id || auth()->user()->is_admin || auth()->user()->is_seller) {
            return view('order.orderDetails', compact('order'));
        } else {
            return redirect()->abort('4o4');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function updatePaymentStatus(Order $order)
    {
        $order->status = "Payment Varified";
        $order->save();
        return redirect()->back()->with('status', 'Order Updated Successfully');
    }

    public function cancelPaymentStatus(Order $order)
    {
        $order->status = "Payment Canceled";
        $order->save();
        return redirect()->back()->with('error', 'Order Updated Successfully');
    }

    public function confirmOrder(OrderDetails $orderDetails)
    {
        $orderDetails->status = "Order Confirmed";
        $orderDetails->save();
        $totalProducts = count($orderDetails->order->orderDetails);
        $confirmedProducts = 0;
        foreach ($orderDetails->order->orderDetails as $od) {
            if ($od->status == "Order Confirmed") {
                $confirmedProducts += 1;
            }
        }
        if ($totalProducts ==  $confirmedProducts) {
            $orderDetails->order->status = "Order Processed:Full";
        } else {
            $orderDetails->order->status = "Order Processed:Partial";
        }
        $orderDetails->order->save();
        return redirect()->back()->with('status', 'Order Updated Successfully');
    }
    public function cancelOrder(OrderDetails $orderDetails)
    {
        $orderDetails->status = "Order Cancled";
        $orderDetails->save();
        $totalProducts = count($orderDetails->order->orderDetails);
        $canledProducts = 0;
        foreach ($orderDetails->order->orderDetails as $od) {
            if ($od->status == "Order Cancled") {
                $canledProducts += 1;
            }
        }
        if ($totalProducts ==  $canledProducts) {
            $orderDetails->order->status = "Order Processed:Full";
        } else {
            $orderDetails->order->status = "Order Processed:Partial";
        }
        $orderDetails->order->save();
        return redirect()->back()->with('status', 'Order Updated Successfully');
    }
    public function productShipped(OrderDetails $orderDetails)
    {
        $orderDetails->status = "Shipped";
        $orderDetails->save();
        return redirect()->back()->with('status', 'Order Updated Successfully');
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
        if ($lat != 'na' || $lon != 'na') {
            $query = $lat . ',' . $lon;
            $geocoder = new \OpenCage\Geocoder\Geocoder('83d88a1f9eac460bb380ab54bb477a28');
            $result = $geocoder->geocode($query); # latitude,longitude (y,x)
            $location = $result['results'][0]['formatted'];
        } else {
            $location = '';
        }

        return view('order.checkout', compact('products', 'cart', 'location'));
    }
    public function orderRating(Request $request, OrderDetails $orderDetail)
    {
        $this->validate($request, [
            'rating' => ['required', 'min:0', 'max:5'],
            'feedback' => ['required', 'min:5', 'max:1000'],
        ]);
        ProductRating::create([
            'rating' => $request->rating,
            'order_details_id' => $orderDetail->id,
            'feedback' => $request->feedback,
        ]);
        $orderDetail->status = "Completed";
        $orderDetail->save();
        return redirect()->back()->with('status', 'Feedback Provided!');
    }
}
