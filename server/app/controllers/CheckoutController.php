<?php

class CheckoutController extends \BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $products = Input::get('products');

        foreach ($products as $product) {
            // Update the stock.
            $outStock = Stock::where('product_id', '=', $product['id'])->first();
            $outStock = ($outStock == null) ? new Stock : $outStock;
            $outStock->shop_id = Input::get('shop_id');
            $outStock->product_id = $product['id'];
            $outStock->quantity -= $product['quantity'];
            $outStock->save();

            // Update the logs.
            $outLog = new StockLog;
            $outLog->shop_id = Input::get('shop_id');
            $outLog->product_id = $product['id'];
            $outLog->user_id = Auth::user()->id;
            $outLog->lot = substr(strtoupper(md5(time() + rand(0, 1000))), 0, 14);
            $outLog->quantity = -$product['quantity'];
            $outLog->save();
        }
    }

}
