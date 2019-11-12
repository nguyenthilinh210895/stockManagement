<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class WarehouseController extends Controller
{
      /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.warehouse.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Area::all();
        return view('content.warehouse.create', compact('area'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($warehouse_id)
    {
        $area = Area::all();
        dd($warehouse_id);
    return view('content.warehouse.edit',compact(['warehouse_id','area']));
    }

}
