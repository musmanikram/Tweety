<?php

namespace App;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tweet extends Model
{
	/**
	 * Added HasEvents so we can hook when the Tweet is being deleted.
	 */
    use Likable, HasEvents;

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
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function getImageAttribute($value)
	{
		return $value ? asset('storage/' . $value ) : '';
	}
}
