<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function show() {
        return view('user.show');
    }

    public function edit() {
        return view('user.edit');
    }

    public function update(Request $request) {
        $id = Auth::user()->id;
        //validation
        $this->validator($request->all(), $id)->validate();

        //set the new values
        $user = Auth::user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->password && $request->password_confirmation) {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        //return back
        return back()->with('success', __('Datos actualizados con éxito'));


        // return $request->all();
    }

    public function validator(array $data, $id) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'not_regex: /\d+/'],
            'surname' => ['required', 'string', 'max:255', 'not_regex: /\d+/'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'current_password' => [
                Rule::requiredIf($data['password'] || $data['password_confirmation'] ),
                new MatchOldPassword,
                'nullable'
            ],
            'password' => [
                Rule::requiredIf($data['current_password'] || $data['password_confirmation']),
                'min:8',
                'nullable',
                'confirmed'
            ],
        ]);
    }

    public function updateImage(Request $request) {
        $user = Auth::user();
        $current_image = $user->image;

        $image = $request->file('image');
        if ($image) {
            //save the image on storage
            $path = $image->store('users');
            $imagePathName =  basename($path);
            $user->image = $imagePathName;
            $result = $user->update();
            if ($result) {
                if ($current_image != 'default.jpg' && Storage::disk('users')->exists($current_image)) {
                    Storage::delete('users/'.$current_image);
                }
            }
        }
        return back();
    }

    public function showImage($filename) {
        $image = Storage::disk('users')->get($filename);
        return new Response($image, 200);
    }
}
