<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManufacturerResource as ManufacturerResource;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Requests\ManufacturerRequest;

class ManufacturerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Manufacturer::all()->map(function ($manu){
                return new ManufacturerResource($manu);
            })
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManufacturerRequest $request)
    {
        $manu = new Manufacturer();
        $manu->name = $request->name;
        $manu->address = $request->address;
        $manu->phone = $request->phone;
        $manu->fax = $request->fax;
        $manu->email = $request->email;
        $manu->save();

        $message = ['status' => 'success', 'content' => 'Create manufacturer successfully'];
        return response()->json(['url'=> route('manufacturers.index'), 'message' => $message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($manu_id)
    {
        $manu = Manufacturer::find($manu_id);
        return new ManufacturerResource($manu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManufacturerRequest $request, $id)
    {
        $manu = Manufacturer::find($id);
        $manu->name = $request->name;
        $manu->address = $request->address;
        $manu->phone = $request->phone;
        $manu->fax = $request->fax;
        $manu->email = $request->email;
        $manu->save();

        $message = ['status' => 'success', 'content' => 'Edit manufacturer successfully'];
        return response()->json(['url'=> route('manufacturers.index'), 'message' => $message], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manufacturer::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete manufacturer successfully'];
        return response()->json(['url'=> route('manufacturers.index'), 'message' => $message], 200);
    }
}
