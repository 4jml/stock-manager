<?php

class DriveOrderLinesController extends \BaseController {

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $line = DriveOrderLine::find($id);
        $line->quantity = Input::get('quantity');
        $line->prepared = Input::get('prepared');
        $line->save();

        return Response::json($line);
    }
}
