<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    /**
     * The product carted
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The user who carted the product
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
