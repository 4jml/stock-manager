<?php

class OrderLinesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($orderId)
    {
        $orderLines = Order::findOrFail($orderId)->orderLines;
        return Response::json($orderLines);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function store($orderId)
    {
        $inputs = array_merge(Input::all(), array('order_id' => $orderId));

        $validator = Validator::make($inputs, array(
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer'
        ));

        $order = Order::findOrFail($orderId);

        if ($validator->passes() && !$order->validated) {
            $orderLine = new OrderLine;
            $orderLine->fill($inputs);

            $productState = Product::findOrFail(Input::get('product_id'))->state();
            $orderLine->product_state_id = $productState->id;
            $orderLine->save();

            return Response::json($orderLine);
        } else {
            return Response::json($validator->messages(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($orderId, $orderLineId)
    {
        $validator = Validator::make(Input::all(), array(
            'product_id' => 'required|integer',
            'quantity' => 'required|integer'
        ));

        $order = Order::findOrFail($orderId);

        if ($validator->passes()  && !$order->validated) {
            $orderLine = OrderLine::findOrFail($orderLineId);
            $orderLine->fill(Input::all());

            $productState = Product::findOrFail(Input::get('product_id'))->state();
            $orderLine->product_state_id = $productState->id;
            $orderLine->save();

            return Response::json($orderLine);
        } else {
            return Response::json($validator->messages(), 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($orderId, $orderLineId)
    {
        $order = Order::findOrFail($orderId);

        if (!$order->validated) {
            OrderLine::destroy($orderLineId);
        }
    }

}
