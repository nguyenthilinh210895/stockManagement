<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quality;
use Illuminate\Http\Request;
use App\Http\Resources\QualityResource as QualityResource;

class QualityApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Quality::all()->map(function ($quality) {
                return new QualityResource($quality);
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quality = new Quality();
        $quality->quality_name = $request->quality_name;
        $quality->quality_code = $request->quality_code;
        $quality-> save();
        $message = ['status' => 'success', 'content' => 'Add quality successfully'];
        return response()->json(['url'=> route('qualitys.index'), 'message' => $message], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quality::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete quality successfully'];
        return response()->json(['url'=> route('qualitys.index'), 'message' => $message], 200);
    }
}
