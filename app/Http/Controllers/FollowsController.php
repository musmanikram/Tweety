<?php

namespace App\Http\Controllers;

use App\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        auth()
            ->user()
            ->toggleFollow($user);

        return back()->with('notification', auth()->user()->following($user) ? 'You Followed ' . $user->username : 'You Unfollowed ' . $user->username );
    }
}
