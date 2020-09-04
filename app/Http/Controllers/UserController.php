<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        $user = User::whereUsers_email(request('email'))->first();

        if (!$user) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

//        if (Auth::attempt($request->only(['users_email', 'users_password']))) {
//            $status = 200;
//            $response = [
//                'user' => Auth::user(),
//                'token' => Auth::user()->createToken('bigStore')->accessToken,
//            ];
//        }
//
//        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        try{
            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
        }catch (Exception $exception){
            return 'E-mail уже существует';
        }

        $user->is_admin = 0;
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('bigStore')->accessToken,
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

}
