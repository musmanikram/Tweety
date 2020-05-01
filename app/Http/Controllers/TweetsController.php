<?php

namespace App\Http\Controllers;

use App\Tweet;

class TweetsController extends Controller
{
    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()
                ->user()
                ->timeline(),
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
	        'image' => ['image']
        ]);

	    if (request('image')) {
		    $attributes['image'] = request('image')->store('tweets');
	    } elseif( isset( $attributes['image'])) {
	    	unset( $attributes['image']);
	    }

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'],
	        'image' => isset( $attributes['image'] ) ? $attributes['image'] : '',
        ]);

        return redirect()->route('home');
    }
}
