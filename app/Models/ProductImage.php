<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    

    protected $fillable = [
        'thumbnail', 'full', 'product_id'
    ];


    protected $casts = [
        'product_id' => 'integer'
    ];


    public function product() {
        return $this->belongsto(Product::class);
    }
}
