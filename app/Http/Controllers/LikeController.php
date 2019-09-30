<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function toggleVote($post) {
        $authUser = Auth::user();
        $existingLike = Like::where('user_id', $authUser->id)
                    ->where('post_id', $post)->first();

        if (!$existingLike) {
            //upvote
            $newLike = new Like();
            $newLike->user_id = $authUser->id;
            $newLike->post_id = (int)$post;
            $newLike->save();

            return response()->json([
                'action' => 'upvote',
                'data' => $newLike
            ]);
        } else {
            //downvote
            $existingLike->delete();
            return response()->json([
                'action' => 'downvote',
                'data' => $existingLike
            ]);
        }
    }
}
