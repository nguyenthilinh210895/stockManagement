<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource as ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Product::all()->map(function ($product){
                return new ProductResource($product);
            })
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
       // $product->product_price = $request->product_price;
        $product->out_of_date =  date("Y-m-d", strtotime(request('out_of_date')));
        $product->manufacturer_id  = $request->manufact;
        $product->calculation_unit_id = $request->unit;
        $product->quality_id = $request->quality;
        $product->item_group_id = $request->group;
        $product->save();

        $zone_id = $request['zone'];
        $product->zones()->attach($zone_id,['quantity_input'=>$request->quatity,'quantity_stock'=>$request->quatity] );

        $message = ['status' => 'success', 'content' => 'Add new product successfully.'];
        return response()->json(['url'=> route('products.index'), 'message' => $message], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);
        return new ProductResource($product);
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
        Product::find($id)->delete();
        $message = ['status' => 'success', 'content' => 'Delete product successfully'];
        return response()->json(['url'=> route('products.index'), 'message' => $message], 200);
    }
}
