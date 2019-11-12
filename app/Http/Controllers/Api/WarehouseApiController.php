<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequest;
use Illuminate\Http\Request;
use App\Http\Resources\WarehouseResource as WarehouseResource;
use App\Models\Warehouse;

class WarehouseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Warehouse::all()->map(function ($ware) {
                return new WarehouseResource($ware);
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        $ware = new Warehouse();
        $ware->warehouse_name = $request ->warehouse_name;
        $ware->ware_manage =$request->ware_manage;
        $ware->ware_phone = $request->ware_phone;
        $ware->ware_email = $request->ware_email;
        $ware->area_id =  $request->area_id;
        $ware->save();

        $message = ['status' => 'success', 'content' => 'Create warehouse successfully'];
        return response()->json(['url'=> route('warehouses.index'), 'message' => $message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ware_id)
    {
        $ware = Warehouse::find($ware_id);}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete warehouse successfully'];
        return response()->json(['url'=> route('warehouses.index'), 'message' => $message], 200);

    }
}
