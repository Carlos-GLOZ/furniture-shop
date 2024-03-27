<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    /**
     * The products associated to a receipt
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'receipt_items');
    }

    /**
     * The items associated to a receipt
     */
    public function items()
    {
        return $this->hasMany(ReceiptItem::class);
    }

    /**
     * The user a receipt is bound to
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
