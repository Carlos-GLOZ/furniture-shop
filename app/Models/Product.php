<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     * The reviews of a product
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The receipt items a product belongs to
     */
    public function receiptItems()
    {
        return $this->hasMany(ReceiptItem::class);
    }

    /**
     * The receipts a product is associated with
     */
    public function receipts()
    {
        return $this->belongsToMany(Receipt::class, 'receipt_items');
    }
}
