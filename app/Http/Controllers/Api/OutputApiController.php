<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutputResource as OutputResource;
use App\Models\DetailOutputWare;
use App\Models\OutputWare;
use App\Models\Product;
use App\Models\ProductZone;
use Illuminate\Http\Request;

class OutputApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => OutputWare::all()->map(function ($output) {
                return new OutputResource($output);
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
        $output = new OutputWare();
        $output->output_code = $request->output_code;
        $output->output_content=isset($request->output_content) ? $request->output_content : '';
        $output->output_date= date("Y-m-d", strtotime(request('output_date')));
        $output->user_id= $request->user_id;
        $output->save();
        if ($request->get('product_id')) {
            foreach ($request->get('product_id') as $index=>$product_id) {
                $product = new DetailOutputWare();
                $getProduct = Product::where('id', $product_id)->first();
                $product->product_id = $product_id;
                $product->detail_estimate_quantity = $request->estimate_quantity[$index];
                $product->detail_output_amount = $request->estimate_quantity[$index] * $getProduct['product_price'];
                $product->outputWare_id = $output->id;
               // $product->zone_id =  $request->zone_id[$index];
                $product->save();
                //$zone = $getProduct->zones()->get();
//                $proz = DB::table('product_zone')
//                    ->where('product_id',$product_id)
//                    ->where('zone_id',$request->zone_id[$index])
//                    ->first();
////                  $productZone = ProductZone::where('product_id',$product_id)->first();
////                  $proz =  $productZone->where('zone_id',$zone[0]->id)->first();
//                if (!is_null($proz)) {
//                    DB::table('product_zone')
//                        ->where('product_id',$product_id)
//                        ->where('zone_id',$request->zone_id[$index])
//                        ->update([
//                            'quantity_output' =>$proz->quantity_output + $request->estimate_quantity[$index],
//                            'quantity_stock' => $proz->quantity_stock - $request->estimate_quantity[$index],
//                        ]);
//
//                }
            };
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($output_id)
    {
        $output =OutputWare::find($output_id);
        return new OutputResource($output);
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
