<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json(['exists' => $exists]);
    }

        public function register(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'birthday' => 'required|date|before:2021-01-01',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city' => $data['city'],
            'phone' => $data['phone'],
            'birthday' => $data['birthday'],
            'loyalty_level_id' => 1,
        ]);

            // для активации через email
            $user->sendEmailVerificationNotification();
            event(new Registered($user));


            return response()->json([
                'success' => true,
                'message' => 'Регистрация прошла успешно. Подтверди email по ссылке в письме!'
            ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Неверные данные для входа',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Попытка входа
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Проверка подтверждения email
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();

                return response()->json([
                    'success' => false,
                    'message' => 'Пожалуйста, подтвердите вашу почту перед входом.',
                ], 403);
            }

            return response()->json([
                'success' => true,
                'message' => 'Успешный вход',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Неверный пароль',
        ], 401);
    }

}