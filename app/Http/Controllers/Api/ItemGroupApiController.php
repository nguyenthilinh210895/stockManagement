<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemGroupResource as ItemGroupResource;
use App\Models\ItemGroup;
use Illuminate\Http\Request;
use App\Http\Requests\ItemGroupRequest;

class ItemGroupApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => ItemGroup::all()->map(function ($group){
                return new ItemGroupResource($group);
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemGroupRequest $request)
    {
        $item = new ItemGroup();
        $item->group_code = $request->group_code;
        $item->group_name = $request->group_name;
        $item->save();

        $zone = $request->input('zone');
        $item->zones()->attach($zone);

        $message = ['status' => 'success', 'content' => 'Create item group successfully'];
        return response()->json(['url'=> route('items.index'), 'message' => $message], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id)
    {
        $group = ItemGroup::find($group_id);
        return new ItemGroupResource($group);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemGroupRequest $request, $id)
    {
        $group = ItemGroup::find($id);
        $group->group_code = $request->group_code;
        $group->group_name = $request->group_name;
        $group->save();
        $zone_id = $request['zone'];
        $group->zones()->detach();
        $group->zones()->attach($zone_id);

        $message = ['status' => 'success', 'content' => 'Edit item group successfully'];
        return response()->json(['url'=> route('items.index'), 'message' => $message], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ItemGroup::find($id)->delete();

        $message = ['status' => 'success', 'content' => 'Delete item group successfully'];
        return response()->json(['url'=> route('items.index'), 'message' => $message], 200);
    }
}
