<?php

class TransportLinesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($transportId)
    {
        $transportLines = Transport::findOrFail($transportId)->transportLines;
        return Response::json($transportLines);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function store($transportId)
    {
        $inputs = array_merge(Input::all(), array('transport_id' => $transportId));

        $validator = Validator::make($inputs, array(
            'transport_id' => 'required|exists:transports,id',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:0'
        ));

        $transport = Transport::findOrFail($transportId);

        if ($validator->passes() && !$transport->validated) {
            $transportLine = new TransportLine;
            $transportLine->fill($inputs);

            $productState = Product::findOrFail(Input::get('product_id'))->state();
            $transportLine->product_state_id = $productState->id;
            $transportLine->save();

            return Response::json($transportLine);
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
    public function update($transportId, $transportLineId)
    {
        $validator = Validator::make(Input::all(), array(
            'product_id' => 'integer',
            'quantity' => 'integer|min:0'
        ));

        $transport = Transport::findOrFail($transportId);

        if ($validator->passes()  && !$transport->validated) {
            $transportLine = TransportLine::findOrFail($transportLineId);
            $transportLine->fill(Input::all());

            $productState = Product::findOrFail(Input::get('product_id'))->state();
            $transportLine->product_state_id = $productState->id;
            $transportLine->save();

            return Response::json($transportLine);
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
    public function destroy($transportId, $transportLineId)
    {
        $transport = Transport::findOrFail($transportId);

        if (!$transport->validated) {
            TransportLine::destroy($transportLineId);
        }
    }

}
