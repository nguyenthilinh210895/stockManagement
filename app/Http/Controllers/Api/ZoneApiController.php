<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ZoneRequest;
use App\Models\Zone;
use App\Http\Resources\ZoneResource as ZoneResource;

class ZoneApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Zone::all()->map(function ($zone) {
                return new ZoneResource($zone);
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        $zone = new Zone();
        $zone->zone_code = $request->zone_code;
        $zone->attribute = $request->attribute;
        $zone->warehouse_id = $request->warehouse_id;
        $zone->save();

        $message = ['status' => 'success', 'content' => 'Create zone successfully'];
        return response()->json(['url'=> route('zones.index'), 'message' => $message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zone_id)
    {
        $zone = Zone::find($zone_id);
        return new ZoneResource($zone);
    }

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
        //
    }
}
