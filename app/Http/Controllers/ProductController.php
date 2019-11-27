<?php

namespace App\Http\Controllers;

use App\Models\CalculationUnit;
use App\Models\ItemGroup;
use App\Models\Manufacturer;
use App\Models\Quality;
use App\Models\Zone;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.product.product_show');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zone = Zone::all();
        $manufacturer = Manufacturer::all();
        $calculation_unit = CalculationUnit::all();
        $item_group = ItemGroup::all();
        $quality = Quality::all();
        return view('content.product.product_create',compact('zone','manufacturer','calculation_unit','item_group','quality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $zone = Zone::all();
        $manufacturer = Manufacturer::all();
        $calculation_unit = CalculationUnit::all();
        $item_group = ItemGroup::all();
        $quality = Quality::all();
        return view('content.product.product_edit',compact('zone','manufacturer','calculation_unit','item_group','quality','product_id'));
    }



}
