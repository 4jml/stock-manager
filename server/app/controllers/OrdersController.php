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
            $orders->load('orderLines');
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
            'supplier_id' => 'required|exists:suppliers,id',
            'validated' => 'boolean'
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
            $order->load('orderLines');
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
            'supplier_id' => 'exists:suppliers',
            'validated' => 'boolean'
        ));

        if ($validator->passes()) {
            $order = Order::find($id);
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
        Order::destroy($id);
        return Response::make();
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
