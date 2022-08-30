<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;

class HomeController extends Controller
{
    public function index() {

        $orders = Order::get();
        $clients = Client::get();
        $products = Product::get();

        $orders_czk = Order::where('currency', 'CZK')->get();
        $orders_eur = Order::where('currency', 'EUR')->get();

        $total = $orders_czk->sum('full_price') + ($orders_eur->sum('full_price')*25);

        return view('home', [
            'total' => $total, 
            'total_czk' => $orders_czk->sum('full_price'), 
            'total_eur' => $orders_eur->sum('full_price') * 25,  
            'orders_count' => $orders->count(),
            'clients_count' => $clients->count(),
            'products_count' => $products->count(),
        ]);
    }


  
}
