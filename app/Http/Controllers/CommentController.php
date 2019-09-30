<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $_POST['post_id'];
        $comment->content = $_POST['content'];
        $result = $comment->save();

        if ($result) {
            return response()->json([
                'status' => 'success',
                'data' => $comment,
                'user' => $comment->user->username
            ]);
        }
    }
}
