<?php

class DriveOrdersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = DriveOrder::where(function($query) {
            if (Input::has('prepare')) {
                $query->whereNull('user_id');
            }
            if (Input::has('preparing')) {
                $query->whereNotNull('user_id')->where('prepared', false);
            }
            if (Input::has('prepared')) {
                $query->where('prepared', true);
                $query->where('delivered', false);
                $query->where('canceled', false);
            }
            if (Input::has('delivered')) {
                $query->where('delivered', true);
            }
            if (Input::has('canceled')) {
                $query->where('canceled', true);
            }
        })
        ->get();

        if (Input::has('nesting')) {
            $orders->load('lines');
            $orders->load('lines.productState');
            $orders->load('customer');
            $orders->load('user');

            foreach ($orders as $order) {
                $total = 0;
                $quantity = 0;

                foreach ($order->lines as $line) {
                    $total += $line->productState->price * $line->availableQuantity;
                    $quantity += $line->availableQuantity;
                }

                $order->total = $total;
                $order->quantity = $quantity;
            }
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
            $order->date = Carbon::parse(Input::get('date'));
            $order->reference = strtoupper(substr(Auth::user()->lastname, 0, 2)) . Carbon::now()->format('dm') . rand(1000, 9999);

            while ($order->code == NULL) {
                $code = rand(1000, 9999);
                $count = DriveOrder::where('code', $code)->where('date', 'LIKE', $order->date->format('Y-m-d') . '%')->count();
                if (! $count)
                    $order->code = $code;
            }

            $order->save();

            $products_cleaned = array_unique(Session::get('basket', array()));
            asort($products_cleaned);

            foreach ($products_cleaned as $entry)
            {
                $product = Product::find($entry);
                $product->quantity = count(array_keys(Session::get('basket', array()), $entry));
                $line = new DriveOrderLine;
                $line->drive_order_id = $order->id;
                $line->product_id = $product->id;
                $line->product_state_id = $product->state()->id;
                $line->quantity = $product->quantity;
                $line->availableQuantity = $product->quantity;
                $line->save();
            }

            Session::forget('basket');

            $order = DriveOrder::find($order->id);
            $order->load('lines');
            $order->load('lines.productState');
            $order->load('customer');
            $order->load('user');
            $email = $order->customer->email;

            Mail::send('emails.drive.order', array('order' => $order), function($message) use ($email)
            {
                $message->from(Config::get('app.drive_from'), Config::get('app.drive_name'));
                $message->to($email);
                $message->setSubject("Validation de votre commande");
            });

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
        $order = DriveOrder::findOrFail($id);

        if (Input::has('nesting')) {
            $order->load('lines');
            $order->load('lines.productState');
            $order->load('customer');
            $order->load('user');

            $total = 0;
            $quantity = 0;

            foreach ($order->lines as $line) {
                $total += $line->productState->price * $line->availableQuantity;
                $quantity += $line->availableQuantity;
            }

            $order->total = $total;
            $order->quantity = $quantity;
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
            $order = DriveOrder::findOrFail($id);
            $order->fill(Input::all());
            $order->save();

            if (Input::get('delivered')) {
                $lines = DriveOrderLine::where('drive_order_id', '=', $order->id)->get();

                foreach ($lines as $line) {
                    // Update the stock.
                    $outStock = Stock::where('product_id', '=', $line->product_id)->first();
                    $outStock = ($outStock == null) ? new Stock : $outStock;
                    $outStock->shop_id = $order->shop_id;
                    $outStock->product_id = $line->product_id;
                    $outStock->quantity -= $line->quantity;
                    $outStock->save();

                    // Update the logs.
                    $outLog = new StockLog;
                    $outLog->shop_id = $order->shop_id;
                    $outLog->product_id = $line->product_id;
                    $outLog->user_id = Auth::user()->id;
                    $outLog->lot = substr(strtoupper(md5(time() + rand(0, 1000))), 0, 14);
                    $outLog->quantity = -$line->quantity;
                    $outLog->save();
                }
            }

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
        DriveOrder::destroy($id);
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

    public function code($code)
    {
        $order = DriveOrder::where('code', $code)->firstOrFail();

        if (Input::has('nesting')) {
            $order->load('lines');
            $order->load('lines.productState');
            $order->load('customer');
            $order->load('user');

            $total = 0;
            $quantity = 0;

            foreach ($order->lines as $line) {
                $total += $line->productState->price * $line->availableQuantity;
                $quantity += $line->availableQuantity;
            }

            $order->total = $total;
            $order->quantity = $quantity;
        }

        return Response::json($order);
    }

}
