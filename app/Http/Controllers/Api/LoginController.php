<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\traits\ApiTrait;
use Illuminate\Http\Request;
use function auth;
use function redirect;

class LoginController extends Controller
{
    use ApiTrait;
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (auth()->attempt($credentials) && (auth()->user()->role == 'admin')) {
            // create token
            $token = auth()->user()->createToken($request->DeviceName ?? $request->userAgent())
                ->plainTextToken;
            // return response
            return $this->apiResponse('201' , 'User Login Successfully' , 'null' , $token);
        }
        return $this->apiResponse('401' , 'Invalid Credentials' , 'null' , 'null');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiResponse('200' , 'User Logout Successfully' , 'null' , 'null');
    }
}


