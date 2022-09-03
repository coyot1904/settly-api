<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $userCount = User::where('email', $request->input('email'));
        if ($userCount->count()) {
            return response(['message' => 'false']);
        }
        else{
            User::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            return response(['message' => 'true']);
        }
    }
    //------------
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email' , 'password')))
        {
            return response(['message' => 'Invalied credenrtials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'token' => $token,
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
        ])->withCookie($cookie);
    }
    //------------
    public function user()
    {
        return Auth::user();
    }
    //------------
    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
    //------------
}
