<?php

class DriveOrdersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::all();

        if (Input::has('nesting')) {
            $orders->load('lines');
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
        if (! Auth::check()) {
            App::abort(401, 'Forbidden.');
        }

        $validator = Validator::make(Input::all(), array(
            'shop_id' => 'required',
        ));

        if ($validator->passes()) {
            $order = new DriveOrder;
            $order->shop_id = Input::get('shop_id');
            $order->customer_id = Auth::user()->id;
            $order->date = Input::get('date');
            $order->save();

            $products_cleaned = array_unique(Session::get('basket', array()));
            asort($products_cleaned);

            foreach ($products_cleaned as $entry)
            {
                $product = Product::find($entry);
                $product->quantity = count(array_keys(Session::get('basket', array()), $entry));
                $line = new DriveOrderLine;
                $line->driveorder_id = $order->id;
                $line->product_state_id = $product->state()->id;
                $line->quantity = $product->quantity;
                $line->save();
            }

            Session::forget('basket');

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
