<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class StatsController extends Controller
{
    public function index() {

        $order = new Order();
        $orders = $order->getOrdersPriceByDays();

        $order_item = new OrderItem();
        $items_sold_this_month = $order_item->getItemsSoldThisMonth();
        $items_sold_last_month = $order_item->getItemsSoldLastMonth();

        $product = new Product();
        $products = $product->getProducts();

        $items_sold = [];
        foreach($products as $product) {
            $items_sold[$product->id] = $order_item->getItemsSoldByMonths($product->id);
        }
        //dd($items_sold_last_month);
        return view('stats.index', ['orders' => $orders, 'items_sold' => $items_sold, 'items_sold_this_month' => $items_sold_this_month, 'items_sold_last_month' => $items_sold_last_month]);
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

    public function getSoldItemsByDate(Request $request) {
        $order_item = new OrderItem();
        $items_sold_date = $order_item->getItemsSoldByDate($request->date_from, $request->date_to);
        return $items_sold_date;
    }

    public function getSalesByDate(Request $request) {
        $order = new Order();
        $sales_date = $order->getSalesByDate($request->date_from, $request->date_to);
        return $sales_date;
    }
}
