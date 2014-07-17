<?php

class TransportsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transports = Transport::all();

        if (Input::has('nesting')) {
            $transports->load('driver', 'vehicule', 'departure', 'arrival');
        }

        return Response::json($transports);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), array(
            'driver_id' => 'required|exists:drivers,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'departure' => 'integer',
            'arrival' => 'integer',
            'start' => 'required|date',
            'end' => 'date'
        ));

        if ($validator->passes()) {
            $transport = Transport::create(Input::all());
            return Response::json($transport);
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
        $transport = Transport::findOrFail($id);

        if (Input::has('nesting')) {
        	$transport->load('transportLines', 'transportLines.productState');
        }

        return Response::json($transport);
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
            'driver_id' => 'exists:drivers,id',
            'vehicule_id' => 'exists:vehicules,id',
            'departure' => 'integer',
            'arrival' => 'integer',
            'start' => 'date',
            'end' => 'date'
        ));

        $transport = Transport::find($id);

        if ($validator->passes() && !$transport->validated) {
            if (Input::get('validated') && !$transport->end && !Input::has('end')) {
                return Response::json(array(
                    'end' => "Une date d'arrivée doit être spécifiée."
                ), 400);
            }

            $transport->fill(Input::all());
            $transport->validated = Input::get('validated');
            $transport->save();

            if (Input::get('validated')) {
                $lines = TransportLine::where('transport_id', '=', $transport->id)->get();

                foreach ($lines as $line) {
                    $lot = substr(strtoupper(md5(time() + rand(0, 1000))), 0, 14);

                    // Below comes the logging shitstorm.

                    // Update the output stock.
                    $outStockClass = ($transport->departure != null) ? 'Stock' : 'CentralStock';

                    $outStock = call_user_func($outStockClass . '::where', 'product_id', '=', $line->product_id)->first();
                    $outStock = ($outStock == null) ? new $outStockClass : $outStock;

                    if ($transport->departure != null)
                        $outStock->shop_id = $transport->departure;

                    $outStock->product_id = $line->product_id;
                    $outStock->quantity -= $line->quantity;
                    $outStock->save();

                    // Update the output logs.
                    $outLogClass = ($transport->departure != null) ? 'StockLog' : 'CentralStockLog';

                    $outLog = new $outLogClass;

                    if ($transport->departure != null)
                        $outLog->shop_id = $transport->departure;

                    $outLog->product_id = $line->product_id;
                    $outLog->transport_id = $transport->id;
                    $outLog->user_id = Auth::user()->id;
                    $outLog->lot = $lot;
                    $outLog->quantity = -$line->quantity;
                    $outLog->save();

                    // Update the input stock.
                    $inStockClass = ($transport->arrival != null) ? 'Stock' : 'CentralStock';

                    $inStock = call_user_func($inStockClass . '::where', 'product_id', '=', $line->product_id)->first();
                    $inStock = ($inStock == null) ? new $inStockClass : $inStock;

                    if ($transport->arrival != null)
                        $inStock->shop_id = $transport->arrival;

                    $inStock->product_id = $line->product_id;
                    $inStock->quantity += $line->quantity;
                    $inStock->save();

                    // Update the input logs.
                    $inLogClass = ($transport->arrival != null) ? 'StockLog' : 'CentralStockLog';

                    $inLog = new $inLogClass;

                    if ($transport->arrival != null)
                        $inLog->shop_id = $transport->arrival;

                    $inLog->product_id = $line->product_id;
                    $inLog->transport_id = $transport->id;
                    $inLog->user_id = Auth::user()->id;
                    $inLog->lot = $lot;
                    $inLog->quantity = $line->quantity;
                    $inLog->save();
                }
            }

            return Response::json($transport);
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
        $transport = Transport::find($id);

        if (!$transport->validated) {
            Transport::destroy($id);
            return Response::make();
        } else {
            return Response::json(null, 400);
        }
    }

}
