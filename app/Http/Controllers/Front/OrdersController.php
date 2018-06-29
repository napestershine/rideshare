<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Docs\OrderController;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends OrderController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse {
        if($request->exists('restaurant_id')) {
            $restaurants = Restaurant::whereId($request->get('restaurant_id'))->first();
            if(empty($restaurants)) {
                return response()->json(['status'=>__LINE__,'msg'=>'Invalid Parameter. Restaurant not found'], 404);
            }
            $orders=$restaurants->orders()->orderBy('created_at', 'desc')->get();
        } else {
            $user = $this->getUser();
            $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        }
        return response()->json(['status'=>0,'msg'=>'success','data'=>$orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $this->validate($request, [
             'restaurant_id' => 'required',
             'address_id' => 'required'
        ]);
        $user = $this->getUser();
        $data['user_id']=$user->id;
        $order = Order::create($request->all());
        return response()->json(['status'=>0,'msg'=>'success','data'=>$order], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse {
        $order = Order::find($id);
        if (empty($order)) {
            return response()->json(['status'=>__LINE__,'msg'=>'Order not found'], 404);
        }
        return response()->json(['status'=>0,'msg'=>'success','data'=>$order], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse {
        //
    }
}
