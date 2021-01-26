<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'iamge', 'description', 'amount', 'price', 'color'];
    public $timestamps = false;
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
