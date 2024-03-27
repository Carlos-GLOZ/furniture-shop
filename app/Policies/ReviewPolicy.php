<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Delete a review
     */
    public function delete(User $user, Review $review)
    {
        if ($user->admin == 1 || $user->id == $review->user_id) {
            return true;
        }

        return false;
    }
}
