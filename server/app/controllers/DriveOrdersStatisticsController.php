<?php

class DriveOrdersStatisticsController extends \BaseController {
	public function getOrdersCount() {
		$count = DriveOrder::where('date', 'LIKE', Carbon::now()->format('Y-m') . '%')->count();
		return Response::json(array('count' => $count));
	}
	public function getCustomersCount() {
		$count = Customer::where('created_at', 'LIKE', Carbon::now()->format('Y-m') . '%')->count();
		return Response::json(array('count' => $count));
	}
	public function getDeliveredPercent() {
		$total = DriveOrder::where('date', 'LIKE', Carbon::now()->format('Y-m') . '%')->count();
		$delivered = DriveOrder::where('date', 'LIKE', Carbon::now()->format('Y-m') . '%')->where('delivered', true)->count();
		$percent = ($delivered * 100) / $total;
		return Response::json(array('percent' => round($percent)));
	}
	public function getOrdersRevenue() {
		$orders = DriveOrder::where('date', 'LIKE', Carbon::now()->format('Y-m') . '%')->get();
		$total = 0;
		foreach ($orders as $order) {
			$subtotal = 0;
			foreach ($order->lines as $line) {
				$subtotal += $line->productState->price * $line->availableQuantity;
			}
			$total += $subtotal;
		}
		return Response::json(array('total' => round($total)));
	}

}
