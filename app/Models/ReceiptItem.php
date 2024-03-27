<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id',
        'product_id'
    ];

    /**
     * The product associated to an item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The receipt associated to an item
     */
    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
}
