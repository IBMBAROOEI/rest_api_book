<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Traits\fileupload;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    use fileupload;


    public  function  user($id)/* find one user */
    {
        $user=user::find($id);
        return $user;
    }

    public function update(Request $request, $user_id)
    {

        $user = User::find($user_id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|numeric',
            'birthday' => 'required|date',
            'gender' => 'in:male,female',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validator->validated();
        $data['password'] = app('hash')->make($request->get('password'));
        if ($request->File('image')) {
            $user->image = $this->uploadImage($request, 'image');
            $data['image'] = $user->image;
            $user->update($data);
        }
        return response()->json(['message' => 'updated'], 200);
    }

    public  function destroy($user_id){
        $user = User::findOrFail($user_id);
        $user->delete();
        return response()->json(['message' => 'delete'], 200);
    }
}

