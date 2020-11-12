<?php

namespace App\Http\Controllers;
use App\Education;
use App\Http\Controllers\Traits\fileupload;
use App\Mail\useremail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    use fileupload;
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required| email|unique:users',
            'age' => 'required|numeric',
            'birthday' => 'required|date',
            'gender' => 'in:male,female',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $validator->validated();
        $data ['password'] = app('hash')->make($request->get('password'));
        try {
            $user = user::create([
                'name' => $request->name,
                'education_id'=> $request-> education_id,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'age' => $request->age,
                'birthday' => $request->birthday,
                'gender'=> $request->gender,
                'image' => $this->uploadImage($request, 'image'),
            ]);
            $user->save();
            Mail::to($user)->send(new useremail($user));
            return response()->json(['message' => 'CREATED'], 200);
        } catch
        (\Exception $e) {

            return response()->json(['message' => 'useremail Registration Failed!'], 409);

        }
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $user->date_login = Carbon::now()->toDateTimeString();
        $user->save();
        return $this->respondWithToken($token);
    }
}













