<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CalculationUnit;
use Illuminate\Http\Request;
use App\Http\Resources\CalculationResource as CalculationResource;

class CaculationUnitApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => CalculationUnit::all()->map(function ($unit) {
                return new CalculationResource($unit);
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
        $unit = new CalculationUnit();
        $unit->unit_name = $request->unit_name;
        $unit->save();

        $message = ['status' => 'success', 'content' => 'Create calculation unit successfully'];
        return response()->json(['url'=> route('calculations.index'), 'message' => $message], 200);
    }

    public function destroy($id)
    {
        CalculationUnit::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete calculation unit successfully'];
        return response()->json(['url'=> route('calculations.index'), 'message' => $message], 200);
    }
}
