<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Storage;

class ProfileAssetsController extends Controller
{
	/**
	 * Destroy Current User Assets
	 * @param User $user
	 * @param      $asset
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(User $user, $asset ) {
    	switch ( $asset ) {
		    case 'banner':
		    	$attributes = $user->getAttributes();
		    	$storage    = Storage::delete( $attributes['banner'] );

		    	if ( $storage ) {
				    $user->update( [ 'banner' => '' ] );
			    }
			    break;
		    case 'avatar':
			    $attributes = $user->getAttributes();
			    $storage    = Storage::delete( $attributes['avatar'] );
			    if ( $storage ) {
				    $user->update( [ 'avatar' => '' ] );
			    }
		    	break;
	    }

	    return redirect($user->path());
    }
}
