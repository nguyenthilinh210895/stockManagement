<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OutputWareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee =User::all();
        return view('content.outputWare.output_ware_create',compact('employee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function picklist($output_id)
    {
        return view('content.outputWare.output_checklist',compact('output_id'));
    }
}
