<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\ProductDetails;
use App\ProductCategory;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => ['string','max:255'],
            'size' => ['string','max:255'],
            'model' => ['string','max:255',],
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
        $productDetails = ProductDetails::create([
            'color' => $request['color'],
            'size' => $request['size'],
            'model' => $request['model'],
            'product_id' =>$product->id,

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
    public function store(Request $request,Product $product,ProductDetails $productDetails)
    {
        $seller = auth()->user();
        $this->validate($request,[
            'name' => ['required', 'string', ],
            'company_name' => ['required', 'string' ],
            'category_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['required', 'string'],
            'color' => ['string','max:255'],
            'size' => ['string','max:255'],
            'model' => ['string','max:255',],
        ]);
        $product->update([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'category_id' => $request['category_id'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'description' => $request['description'],
            'seller_id' =>$seller->id,

        ]);
        $productDetails->update([
            'color' => $request['color'],
            'size' => $request['size'],
            'model' => $request['model'],
            'product_id' =>$product->id,

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

        return redirect()->route('product.show')->with('status','Product Update successfully!');
    }
    public function delete(Product $product)
    {
        $product->delete();
          return redirect()->back()->with('status', 'Product Deleted Successfully');
    }
    public function destroy(Image $image){
           $image->delete();
           return redirect()->back()->with('status', 'Image Deleted Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('productDetails',compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      $categories=ProductCategory::all();
      return view('seller.product.editProduct',compact('product','categories'));
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
    public function productShowAdmin(User $user)
    {
        $products = Product::where('seller_id',$user->id)->get();
        return view('admin.allProduct.showProduct',compact('products','user'));
    }
    public function productShowseller(User $user)
    {
        $products=Product::where('seller_id',$user->id)->get();
        return view('seller.product.productShow',compact('products','user'));
    }
    public function productSearch(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
        ]);
        $price['max'] = Product::max('price');
        $price['min'] = Product::min('price');
        $query = $request->name;
        $products = Product::where('name','like','%'.$request->name.'%')->paginate(12);
        $categories = ProductCategory::join('products', 'category_id', 'product_categories.id')
            ->select('product_categories.id', 'product_categories.name', 'product_categories.slug', DB::raw('count("product_categories.id") as countCategory'))
            ->groupBy('product_categories.id', 'product_categories.name', 'product_categories.slug')
            ->orderBy('countCategory', 'desc')
            ->take(5)
            ->get();
        $products->appends($request->all());
        return view('searchProduct',compact('products','query','categories','price'));
    }
    public function productSearchRange(Request $request)
    {
        $price['max'] = Product::max('price');
        $price['min'] = Product::min('price');
        $searchPrice = explode(",",$request->price);
        if($request->name != null){
            $products = Product::where('name','like','%'.$request->name.'%')->whereBetween('price',
            [intval($searchPrice[0]), intval($searchPrice[1])])->paginate(12);
            $query = $request->name;
        }else{
            $products = Product::whereBetween('price', [intval($searchPrice[0]), intval($searchPrice[1])])->paginate(12);
            $query = null;
        }
        $categories = ProductCategory::join('products', 'category_id', 'product_categories.id')
            ->select('product_categories.id', 'product_categories.name', 'product_categories.slug', DB::raw('count("product_categories.id") as countCategory'))
            ->groupBy('product_categories.id', 'product_categories.name', 'product_categories.slug')
            ->orderBy('countCategory', 'desc')
            ->take(5)
            ->get();
        $products->appends($request->all());
        return view('searchProduct',compact('products','query','categories','searchPrice','price'));
    }
}
