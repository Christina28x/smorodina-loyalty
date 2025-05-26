<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Проверяем подпись хеша (обязательно)
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Недействительная ссылка подтверждения.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/cabinet')->with('message', 'Email уже был подтверждён.');
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        Auth::login($user); // ← логиним пользователя

         return view('verified');
    }
}


