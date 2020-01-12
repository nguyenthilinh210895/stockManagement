<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutputResource as OutputResource;
use App\Models\DetailOutputWare;
use App\Models\OutputWare;
use App\Models\Product;
use App\Models\ProductZone;
use Illuminate\Http\Request;
use DB;

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
                $product->outputWare_id = $output->id;
               $product->zone_id =  $request->zone_id[$index];
                $product->save();
            };
        };
        $message = ['status' => 'success', 'content' => 'Phiếu xuất kho được tạo thành công'];
        return response()->json(['url'=> route('outputs.index'), 'message' => $message], 200);

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
        $output = OutputWare::find($id);
        $output->status= 1;
        $output->save();
        $detail = $output->detail_output_wares()->delete();
        if ($request->get('product_id')) {
            foreach ($request->get('product_id') as $index=>$product_id) {
                  $product = new DetailOutputWare();
                  $product->product_id = $product_id;
                  $product->detail_estimate_quantity = $request->detail_estimate_quantity[$index];
                  $product->detail_output_quantity = $request->quantity[$index];
                  $product->outputWare_id = $output->id;
                  $product->zone_id =  $request->zone_id[$index];
                  $product->save();
                  $proz = DB::table('product_zone')
                    ->where('product_id',$product_id)
                    ->where('zone_id',$request->zone_id[$index])
                    ->first();
                if (!is_null($proz)) {
                    DB::table('product_zone')
                        ->where('product_id',$product_id)
                        ->where('zone_id',$request->zone_id[$index])
                        ->update([
                            'quantity_output' =>$proz->quantity_output + $request->quantity[$index],
                            'quantity_stock' => $proz->quantity_stock - $request->quantity[$index],
                        ]);

                    }
            };
        };
        $message = ['status' => 'success', 'content' => 'Đã hoàn thành việc xuất hàng'];
        return response()->json(['url'=> route('outputs.index'), 'message' => $message], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($output_id)
    {
        $output = OutputWare::find($output_id);
        $detail = $output->detail_output_wares()->get();
        foreach ($detail as $detail) {
            $detail->delete();
        }
        $output->delete();

        $message = ['status' => 'success', 'content' => 'Phiếu xuất kho đã bị xóa'];
        return response()->json(['url'=> route('outputs.index'), 'message' => $message], 200);
    }
}
