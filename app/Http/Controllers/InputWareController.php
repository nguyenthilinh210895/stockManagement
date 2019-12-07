<?php

namespace App\Http\Controllers;

use App\Models\InputWare;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class InputWareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.inputWahouse.input_warehouse_show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee =User::all();
        return view('content.inputWahouse.input_wahouse_create',compact('employee'));
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

    public function purchase()
    {
        return view('content.inputWahouse.input_wahouse_purchase');
    }



}
