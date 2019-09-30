<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('post.index', compact('posts'));
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
        $post = Post::findOrFail($post);
        $post->delete();
        return back();
    }
}
