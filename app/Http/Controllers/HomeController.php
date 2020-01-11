<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = DB::table('users')->count();
        $inputWarehouse = DB::table('input_wares')->count();
        $outputWare = DB::table('output_wares')->count();
        $product_stock = DB::table('product_zone')->where('quantity_stock','>',0)->count();
        return view('content.index',compact('user','inputWarehouse','outputWare','product_stock'));
    }
}
