<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
   protected $fillable = ['product_id','order_id','color','size','quantity',];

   public function order()
   {
       return $this->belongsTo(Order::class);
   }
   public function product()
   {
       return $this->belongsTo(Product::class);
   }
}
