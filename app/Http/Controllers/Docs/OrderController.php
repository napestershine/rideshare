<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;

abstract class OrderController extends BaseController
{
    /**
     * @SWG\Get(
     *     path="/orders",
     *     summary="List of all the orders",
     *     tags={"Order"},
     *     description="List of all the orders in the database.
           Use restaurant_id in query parameters to get the orders of a specific restaurant.
           If no query parameters are given, it will give the orders of the logged in user.",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="restaurant_id",
     *         in="query",
     *         description="Restaurant ID",
     *         required=false,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized.",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Restaurant Not Found",
     *     )
     * )
     */
    abstract public function index(Request $request);

    /**
     * @SWG\Post(path="/orders",
     *   tags={"Order"},
     *   summary="Creates a new order with given input array",
     *   description="Store a new order in database.",
     *   operationId="createOrder",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Order object",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @SWG\Response(response="200", description="successful operation")
     * )
     */
    abstract public function store(Request $request);

    /**
     * @SWG\Get(
     *     path="/orders/{id}",
     *     summary="Get Order Information",
     *     tags={"Order"},
     *     description="Get Order Information by Order ID.",
     *     operationId="id",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Order ID",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="file",
     *             @SWG\Schema(ref="#/definitions/Order")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid parameter value",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Order Not Found",
     *     )
     * )
     */
    abstract public function show($id);

    /**
     * @ SWG\Put(path="/orders/{id}",
     *   tags={"Order"},
     *   summary="Updated order",
     *   description="Update User. This can only be done by the logged in user.",
     *   operationId="updateOrder",
     *   produces={"application/json"},
     *   @ SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="the Order ID that need to be updated",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @ SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Updated order object",
     *     required=true,
     *     @ SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @ SWG\Response(response=400, description="Invalid Order ID supplied"),
     *   @ SWG\Response(response=404, description="Order not found")
     * )
     */
    abstract public function update(Request $request, $id);

    /**
     * @ SWG\Delete(path="/orders/{id}",
     *   tags={"Order"},
     *   summary="Delete order",
     *   description="This can only be done by the logged in user.",
     *   operationId="deleteOrder",
     *   produces={"application/json"},
     *   @ SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="The Order ID that needs to be deleted",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @ SWG\Response(response=400, description="Invalid Order ID supplied"),
     *   @ SWG\Response(response=404, description="Order not found")
     * )
     */
    abstract public function destroy($id);

}