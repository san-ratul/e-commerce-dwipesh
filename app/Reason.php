<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'reason', 'user_id',
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
