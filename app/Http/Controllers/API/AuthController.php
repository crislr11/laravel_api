<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function register(Request $request){
        $input = $request->all();
        $profileImagePath = null;
        
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        if (request()->hasFile('profile_image')) {
            $profileImagePath = request()->file('profile_image')->store('profile_images', 'public');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'actived' => 0,
            'rol' => $request->rol,
            'profile_picture' => $profileImagePath,
            'email_confirmed' => 0,
            'remember_token' => Str::random(10),
        ]);

        $user->sendEmailVerificationNotification();

        return $this->sendResponse($user, "User created successfully");
    }

    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Eventify')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 500);
        }
    }

}