<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name','composition','description','image','price','user_id','category_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function raitings()
    {
        return $this->hasMany(Raiting::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
