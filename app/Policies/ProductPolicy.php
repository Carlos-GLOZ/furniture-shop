<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Review;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Review a product.
     */
    public function review(User $user, Product $product)
    {
        $isReviewdBy = Review::where(['product_id' => $product->id, 'user_id' => $user->id])->count();

        // Return true if 0 so that policy will return true if product hasn't been reviewd by user
        if ($isReviewdBy == 0) {
            return true;
        }

        return false;
    }

    /**
     * Edit or delete a product
     */
    public function change(User $user, Product $product)
    {
        if ($user->admin == 1) {
            return true;
        }

        return false;
    }


    public function cart(User $user, Product $product)
    {
        $isCartedBy = ShoppingCart::where(['product_id' => $product->id, 'user_id' => $user->id])->count();

        if ($isCartedBy == 0) {
            return true;
        }

        return false;
    }
}
