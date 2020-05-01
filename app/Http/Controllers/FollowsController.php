<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowed;
use App\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        auth()
            ->user()
            ->toggleFollow($user);

	    $followed = auth()->user()->following($user);

        return back()->with('notification', $followed ? 'You Followed ' . $user->username : 'You Unfollowed ' . $user->username );
    }
}
