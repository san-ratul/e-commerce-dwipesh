<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use App\OrderDetails;
use App\ProductCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function welcome(Product $product)
    {
        $products = Product::latest()->paginate(12);
        $bestSellingProducts = Product::join('order_details', 'product_id', 'products.id')
            ->select('products.id', DB::raw('count("products.id") as product_count'))
            ->groupBy('products.id')
            ->orderBy('product_count', 'desc')
            ->take(7)
            ->get();
        return view('welcome', compact('products', 'image', 'bestSellingProducts'));
    }

    public function shop()
    {
        $categories = ProductCategory::join('products', 'category_id', 'product_categories.id')
            ->select('product_categories.id', 'product_categories.name', 'product_categories.slug', DB::raw('count("product_categories.id") as countCategory'))
            ->groupBy('product_categories.id', 'product_categories.name', 'product_categories.slug')
            ->orderBy('countCategory', 'desc')
            ->take(5)
            ->get();
        $products = Product::latest()->paginate(12);
        return view('shop', compact('products','categories'));
    }
    public function category($slug)
    {
        $categories = ProductCategory::join('products', 'category_id', 'product_categories.id')
            ->select('product_categories.id', 'product_categories.name', 'product_categories.slug', DB::raw('count("product_categories.id") as countCategory'))
            ->groupBy('product_categories.id', 'product_categories.name', 'product_categories.slug')
            ->orderBy('countCategory', 'desc')
            ->take(5)
            ->get();
        $currentcategory = ProductCategory::where('slug',$slug)->first();
        $products= Product::join('product_categories', 'product_categories.id', 'products.category_id')
            ->select('products.id')
            ->where('product_categories.id',$currentcategory->id)
            ->paginate(12);
        return view('categoryWiseProduct', compact('products','categories'));
    }
}
