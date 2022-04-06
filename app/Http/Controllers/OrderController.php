<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\OrderItem;
use DataTables;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::All();

        return view('orders.index')->with(['orders' => $orders]);
    }

    public function getOrders(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::latest()->get();
            $data = Order::addSelect(['name' => Client::select('name')
                        ->whereColumn('id', 'orders.client_id')
                        ])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($order){
                    $actionBtn = '<a href="/orders/'.$order->id.'" class="edit btn btn-success btn-sm">Otevřít</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getClientOrders(Request $request)
    {

        if ($request->ajax()) {
            $client = Auth::user();
            $data = Order::where('client_id', $request->client)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($order){
                    $actionBtn = '<a href="/orders/'.$order->id.'" class="edit btn btn-success btn-sm">Otevřít</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::All();
        $products = Product::All();
        return view('orders.create')->with(['clients' => $clients, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $order = new Order();
        $order->client_id = $request->clients;
        $order->full_price = null;
        $order->save();

        $price = 0;

        foreach($request->product as $key => $product) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->client_id = $request->clients;
            $order_item->item_id = $key;
            $order_item->quantity = $product;
            $order_item->unit = "kg";
            $order_item->save();

            $product_item = Product::where('id', $key)->first();
            $price += $product * $product_item->price;
        }

        $order = Order::where('id', $order->id)->first();
        $order->full_price = $price;
        $order->save();

        return redirect('/orders?add_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::addSelect(['client' => Client::select('name')
                        ->whereColumn('id', 'orders.client_id')
                        ])->find($id);

        $order_items = OrderItem::addSelect(['product' => Product::select('name')
                                  ->whereColumn('id', 'order_items.item_id')
                                ])->addSelect(['price' => Product::select('price')
                                  ->whereColumn('id', 'order_items.item_id')
                                ])->where('order_id', $order->id)->get();

        return view('orders.detail')->with(['order' => $order, 'order_items' => $order_items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
