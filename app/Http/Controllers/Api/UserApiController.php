<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditAccountRequest;
use App\Mail\initialPassMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Intervention\Image\Facades\Image as Image;
use Hash;
use Illuminate\Support\Facades\Storage;
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
     *  editAccount function
     *  function for user edit account
     * @param EditAccountRequest $request
     * @return void
     */
    public function editAccount(EditAccountRequest $request)
    {
        $user = User::find($request->id);
        if($request->new_password)
        {
            if(Hash::check($request->old_password,$user->password))
                $user->update([
                    'password' => bcrypt($request->new_password),
                    'email_verified_at' => Carbon::now()
                ]);
            else
                return response()->json(
                    [
                        'error' => ['old_password' => ['The old password is incorrect']],
                        'status_code' => 422,
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        }
        $user->update([
            'fullname' => $request->fullname,
            'employee_id' => $request->employee_id,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birthday' =>  date("Y-m-d", strtotime(request('birthday'))),
            'email' => $request->email,
//            'warehouse_id' => $request->warehouse_id,
        ]);

        // create image
        if ($request->hasFile('image_url'))
        {
            $imagePath = $request->file('image_url')->store('public');
            $url_image = explode('/',  $imagePath , 2);
            $image = Image::make(Storage::get($imagePath))->resize(320,240)->encode();
            Storage::put($imagePath,$image);
            $user->image_url = $url_image[1];
            $user->save();
        }

        $message = ['status' => 'success', 'content' => 'I edited my account information.'];
        return response()->json(['url'=> route('user.profile'), 'message' => $message], 200);
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
