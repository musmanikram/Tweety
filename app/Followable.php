<?php

namespace App;

use App\Notifications\UserFollowed;

trait Followable
{
    public function follow(User $user)
    {
	    $user->notify( new UserFollowed( $this ));

        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        $this->follows()->toggle($user);

	    $followed = $this->following($user);

	    if ( $followed ) {
		    $user->notify( new UserFollowed( $this ));
	    }
    }

    public function following(User $user)
    {
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function follows()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id'
        );
    }
}
