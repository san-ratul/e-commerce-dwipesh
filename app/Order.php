<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total','discount','trx_id','paid','due','status','note'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
