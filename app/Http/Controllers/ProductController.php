<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('seller.product.addProduct',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $seller = auth()->user();
        $this->validate($request,[
            'name' => ['required', 'string', ],
            'company_name' => ['required', 'string' ],
            'category_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['required', 'string'], 
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $product = Product::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'category_id' => $request['category_id'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'description' => $request['description'],
            'seller_id' =>$seller->id,
            
        ]);
        if($request->hasFile('filename')){
            foreach($request->file('filename') as $file){
                $extention=$file->getClientOriginalExtension();
                $filename=time().'.'.$extention;
                $path = '/seller/'.$seller->name.'/product/'.$filename;  
                $file->move(public_path()."/seller/".$seller->name."/product/",$filename);

                Image::create([
                    'image' =>$path,
                    'product_id' =>$product->id,
                    
                ]);
            }          
        }
        
        
        return redirect()->route('product.add')->with('status','Product add successfully!');	
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products=Product::all();
        return view('productDetails',compact('product','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
