<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AreaResource as AreaResource;

use App\Models\Area;

class AreaApiControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Area::all()->map(function ($area) {
                return new AreaResource($area);
            })
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $area = new Area();
        $area->area_code = $request->area_code;
        $area->area_name = $request->area_name;
        $area->save();

        $message = ['status' => 'success', 'content' => 'Create area successfully'];
        return response()->json(['url'=> route('areas.index', $area->id), 'message' => $message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
       Area::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete area successfully'];
        return response()->json(['url'=> route('areas.index'), 'message' => $message], 200);
    }
}
