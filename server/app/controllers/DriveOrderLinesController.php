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
        $line->fill(Input::all());
        $line->save();

        return Response::json($line);
    }
}
