<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = 
    [
        'name',
        'product_details',
        'price',
        'quantity',
        'image'
        
    ];
}
