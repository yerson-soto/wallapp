<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\Comment;
use App\Like;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $posts = Post::orderBy('id', 'desc')->get();
        $users = User::inRandomOrder()->limit(5)->get();
        return view('post.index', compact('posts', 'users'));
    }

    public function show($post) {
        $newPost = Post::find($post);
        return view('post.show', [
            'post' => $newPost
        ]);
    }

    public function store(Request $request) {
        //validation
        $validate = $this->validate($request, [
            'history' => [
                Rule::requiredIf(!$request->image),
                'nullable'
            ],
            'image' => [
                Rule::requiredIf(!$request->history),
                'image',
                'nullable'
            ]
        ]);

        //create new object
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->history = $request->history;
        $image = $request->file('image');

        //save the image if exists
        if ($image) {
            $path = $image->store('posts');
            $imagePathName = basename($path);
            $post->image = $imagePathName;
        }
        //save on db
        $post->save();
        return back();
    }

    public function getPostImage($filename) {
        $file = Storage::disk('posts')->get($filename);
        return new Response($file, 200);
    }

    public function delete(Request $request, $post) {
        $user = Auth::user();
        $postToDelete = Post::findOrFail($post);
        $comments = Comment::where('post_id', $postToDelete->id)->get();

        $likes = Like::where('post_id', $postToDelete->id)->get();

        //delete post comments
        if ($comments && count($comments) >= 1) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }

        //delete post likes
        if ($likes && count($likes) >= 1) {
            foreach ($likes as $like) {
                $like->delete();
            }
        }

        //delete post files
        Storage::disk('posts')->delete($postToDelete->image);

        //delete post
        $postToDelete->delete();

        return back();
    }
}
