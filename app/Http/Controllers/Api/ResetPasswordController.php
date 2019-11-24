<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\ResetPasswordRequest as ResetPassRequest;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use DB;



class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMail(Request $request)
    {
        if (!$user = User::where('email', $request->email)->first())
            return response()->json([
                'status' => false,
                'message' => 'Email address not found'
            ], 200);

        if ($passwordReset = PasswordReset::updateOrCreate(['email' => $user->email], ['token' => Str::random(60)])) {
            $user->notify(new ResetPasswordRequest($passwordReset->token,$user->email));
        }

        return response()->json(['status' => true, 'message' => 'The email was sent successfully. Please confirm.'], 200);
    }

    /**
     * reset function
     *
     * @param ResetPassRequest $request
     * @param [type] $token
     * @return void
     */
    public function resetPassword(ResetPassRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }

        DB::table('users')->where('email', $passwordReset->email)->update(['password' => bcrypt($request->password)]);
        $passwordReset->delete();
        $message = ['status' => 'success', 'content' => 'Password changed'];
        return response()->json(['url'=> route('login'), 'message' => $message], 200);
    }

    public function formReset($token)
    {
        if ($passwordReset = Carbon::parse(PasswordReset::where('token', $token)->value('updated_at'))->addMinutes(720)->isPast())
            abort(403);
        else
            return view('auth.passwords.resetPassword', compact('token'));
    }

}
