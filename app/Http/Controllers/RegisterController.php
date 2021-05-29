<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Jobs\SendEmailUserRegisteredJob;
use App\Models\OTP_Code;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt($request->password),
            'role_id' => 3
        ]);

        return response()->json([
            'message' => 'register berhasil',
        ]);
    } catch (Exception $e) {
        return response()->json([
            'message_' => $e
        ]);
    }
    }
}
