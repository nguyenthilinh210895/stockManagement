<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\initialPassMail;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use  Illuminate\Support\Str;
use App\Http\Resources\UserResource as UserResource;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => User::all()->map(function ($user){
                return new UserResource($user);
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password_random = Str::random(32);
        $user = new User;
        $user->warehouse_id = $request->warehouse;
        $user->password = bcrypt($password_random);
        $user->employee_id = $request->employee_id;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();
        Mail::to($request->email)->send(new initialPassMail($user,$password_random));
        $message = ['status' => 'success', 'content' => 'Add employee successfully'];
        return response()->json(['url'=> route('users.index'), 'message' => $message], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = User::find($user_id);
        return new UserResource($user);
    }
    /**
     * Display the specified resource.
     *
     * @param $email
     * @return UserResource
     */
    public function showProfile($email)
    {
        $user = User::where('users.email', $email)->first();
        return new UserResource($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->warehouse_id = $request->warehouse;
        $user->employee_id = $request->employee_id;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        $message = ['status' => 'success', 'content' => 'Edit employee successfully'];
        return response()->json(['url'=> route('users.index'), 'message' => $message], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete employee successfully'];
        return response()->json(['url'=> route('users.index'), 'message' => $message], 200);
    }
}
