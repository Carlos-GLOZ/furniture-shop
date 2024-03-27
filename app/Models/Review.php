<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'rating',
        'product_id',
        'user_id'
    ];

    /**
     * The product a review is directed towards
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The user a review is written by
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
