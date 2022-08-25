<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;

class HomeController extends Controller
{
    public function index() {

        $total = DB::select(
            DB::raw(
                'SELECT SUM(full_price) as total FROM orders WHERE 1 LIMIT 1'
            )
        );


        return view('home', ['total' => $total[0]->total]);
    }


  
}
