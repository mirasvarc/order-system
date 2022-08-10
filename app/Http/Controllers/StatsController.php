<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;

class StatsController extends Controller
{
    public function index() {

        $order = new Order();
        $orders = $order->getOrdersPriceByDays();

        
        return view('stats.index', compact('orders'));
    }


    public function getOrdersPriceByDays() {
        $order = new Order();
        $orders = $order->getOrdersPriceByDays();
        return $orders;
    }

    public function getSoldItemsByDays() {
        $order = new Order();
        $orders = $order->getSoldItemsByDays();
        dd($orders);
        return $orders;
    }
}
