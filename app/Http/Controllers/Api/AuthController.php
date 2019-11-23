<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Auth;
use DB;


class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['api'], ['except' => ['login']]);
//    }

    /**
     * Admin login via given credentials.
     *
     * @param LoginRequest $request
     * @return UserResource
     */
    public function adminLogin(AdminLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (! $token = auth('web')->attempt($credentials)) {
            return redirect()->back()->with('error','申し訳ありませんが、これらの詳細が見つかりません.')->withInput(['email']);
        };
        $user = User::where('email',$request->email)->first();

        if($request->remember == 'true')
            auth('web')->attempt($credentials,true);
        else
            Auth::login($user);

        $token = auth('api')->attempt($credentials);

        // Authentication passed...
//        if($user->email_verified_at) {
            return redirect()->route('home')->with(['success' => 'Welcom to stock-management', 'token' => $token]);
        //}else{
//            $email = $request->email;
//            return redirect()->route('password.initial', $email);
//        }
    }

    public function adminLogout()
    {
        if (Auth::check() && $user = User::find(Auth::user()->id)){
            $user->updated_at = Carbon::now();
            $user->save();
        }
        Auth::logout();
        return redirect()->route('admin.dashboard');
    }


}
