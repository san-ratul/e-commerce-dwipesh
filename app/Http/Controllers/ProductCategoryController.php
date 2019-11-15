<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('seller.category.index',compact('categories'));
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
        
        $this->validate($request,[
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255','unique:product_categories'],
        ]);

        if($request->parent_id == ''){
            $category = ProductCategory::create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
        }else{
            $category = ProductCategory::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
            ]);
        }
        return redirect()->route('category.index')->with('status','Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
      $categories = ProductCategory::all();
       return view('seller.category.editCategory',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ProductCategory $category)
    {
        
        if($category->slug == $request->slug){
            $this->validate($request,[
                'name' => ['required','string','max:255'],
            ]);
        }else{
            $this->validate($request,[
                'name' => ['required','string','max:255'],
                'slug' => ['required','string','max:255','unique:product_categories'],
            ]);
        }
        
        if($request->parent_id == ''){
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
        }else{
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
            ]);
        }
        return redirect()->route('category.index')->with('status','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
       
        $category->delete();
        return redirect()->route('category.index')->with('status','Category Deleted successfully!');
    }
}
