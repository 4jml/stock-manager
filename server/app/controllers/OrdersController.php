<?php

class OrdersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::all();

        if (Input::has('nesting')) {
            $orders->load('supplier', 'orderLines');
        }

        return Response::json($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), array(
            'supplier_id' => 'required|exists:suppliers,id'
        ));

        if ($validator->passes()) {
            $order = Order::create(Input::all());
            return Response::json($order);
        } else {
            return Response::json($validator->messages(), 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        if (Input::has('nesting')) {
            $order->load('supplier', 'orderLines', 'orderLines.productState');
        }

        return Response::json($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $validator = Validator::make(Input::all(), array(
            'supplier_id' => 'exists:suppliers,id'
        ));

        $order = Order::find($id);

        if ($validator->passes() && !$order->validated) {
            $order->fill(Input::all());
            $order->save();

            return Response::json($order);
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
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order->validated) {
            Order::destroy($id);
            return Response::make();
        } else {
            return Response::json(null, 400);
        }
    }


    /**
     * Search resources from storage.
     *
     * @param  string  $query
     * @return Response
     */
    public function search($query)
    {
        //
    }

}
