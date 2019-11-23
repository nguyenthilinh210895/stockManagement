<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                'message' => 'メールが終了しません。'
            ], 200);

        if ($passwordReset = PasswordReset::updateOrCreate(['email' => $user->email], ['token' => Str::random(60)])) {
            $user->notify(new ResetPasswordRequest($passwordReset->token,$user->email));
        }

        return response()->json(['status' => true, 'message' => 'メールを正常に送信しました。確認してください。'], 200);
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
        $message = ['status' => 'success', 'content' => 'パスワードが変更されました。'];
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
