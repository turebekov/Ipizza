<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raiting extends Model
{
    protected $fillable = [
        'rating','product_id','user_id'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
