<?php

namespace App;

use App\Notifications\UserMentioned;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Tweet extends Model
{
	/**
	 * Added HasEvents so we can hook when the Tweet is being deleted.
	 */
    use Likable, HasEvents, Notifiable;

    protected $guarded = [];

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		// When the tweet is being deleted, delete the image as well.
		static::deleting(function (Tweet $tweet) {
			$attributes = $tweet->getAttributes();
			if ( isset( $attributes['image'] ) && $attributes['image'] ) {
				Storage::delete( $attributes['image'] );
			}
		});

		static::created(function (Tweet $tweet) {
			$users = $tweet->getMentionedUsers();
			if ( ! $users ) {
				return;
			}

			foreach( $users as $user ) {
				$user->notify( new UserMentioned( $tweet ) );
			}
		});
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function getImageAttribute($value)
	{
		return $value ? asset('storage/' . $value ) : '';
	}

	/**
	 * Find users that were mentioned.
	 *
	 * @param $body
	 */
	public function getMentionedUsers()
	{
		$pattern = '/[@]+([A-Za-z0-9-_\.@]+)\b/';
		preg_match_all( $pattern, $this->body, $usernames );

		// Make sure there's only one instance of each username.
		$usernames = array_unique( $usernames[1] );

		// Bail if no usernames.
		if ( empty( $usernames ) ) {
			return false;
		}

		$mentioned_users = array();

		return User::whereIn('username', $usernames)->get();
	}
}
