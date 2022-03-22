<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function userRegistrasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:4'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $validator->errors()->first(),
                    'status' => 404
                ],
                404
            );
        }
        $data = User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        return response()->json([
            'data' => $data,
            'message' => 'success registration',
            'status' => 200,
            'token' => $data->createToken('registertoken')->plainTextToken
        ], 200);
    }
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $validator->errors()->first(),
                    'status' => 404
                ],
                404
            );
        }
        $checkEmail = User::where('email', $request['email'])->first();
        if (!$checkEmail) {
            return response()->json([
                'data' => $checkEmail,
                'message' => 'user not found!',
                'status' => 404
            ], 404);
        }
        $checkPassword = Hash::check($request['password'], $checkEmail['password']);
        if (!$checkPassword) {
            return response()->json([
                'message' => 'password incorrect!',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'data' => $checkEmail,
            'message' => 'success login',
            'status' => 200,
            'token' => $checkEmail->createToken('logintoken')->plainTextToken
        ], 200);
    }
    public function data()
    {
        $user = auth()->user()->id;
        return $user;
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out',
            'token' => $request->user()->tokens()
        ];
    }
}
