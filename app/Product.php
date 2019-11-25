<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'company_name','description', 'price', 'quantity', 'category_id', 'seller_id',
    ];

    public function image()
    {
        return $this->hasMany('App\Image','product_id');
    }
    public function seller(){
        return $this->belongsTo('App\User','seller_id');
    }
    public function category(){
        return $this->belongsTo('App\ProductCategory','category_id');

    }
    public function productDetails(){
        return $this->hasOne('App\ProductDetails','product_id');
    }
    public function orderDetails(){
        return $this->hasMany('App\OrderDetails','product_id');
    }
    public function rating()
    {
        return $this->hasManyThrough('App\ProductRating','App\OrderDetails');
    }
}
