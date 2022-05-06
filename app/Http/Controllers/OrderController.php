<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\OrderItem;
use DataTables;
use PDF;
use Carbon\Carbon;
use DOMDocument;
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

        $orders_count = [
            "monday" => Order::where('day', 'Pondělí')->count(),
            "tuesday" => Order::where('day', 'Úterý')->count(),
            "wednesday" => Order::where('day', 'Středa')->count(),
            "thursday" => Order::where('day', 'Čtvrtek')->count(),
            "friday" => Order::where('day', 'Pátek')->count(),
            "all" => Order::count(),
        ];
       

        return view('orders.index')->with(['orders' => $orders, 'orders_count' => $orders_count]);
    }

    public function getOrders(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::latest()->get();
            $data = Order::addSelect(['name' => Client::select('name')
                            ->whereColumn('id', 'orders.client_id')
                        ])->addSelect(['client_day' => Client::select('day')
                            ->whereColumn('id', 'orders.client_id')
                        ])->get();
        
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($order){
                    $actionBtn = '<a href="/orders/'.$order->id.'" class="edit btn btn-success btn-sm"><i class="fa-solid fa-eye"></i>&nbsp;Zobrazit</a>&nbsp;
                                  <a href="/orders/delete/'.$order->id.'" class="delete btn btn-success btn-sm"><i class="fa-solid fa-trash-can"></i>&nbsp;Odstranit</a>';
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
                    $actionBtn = '<a href="/orders/'.$order->id.'" class="edit btn btn-success btn-sm"><i class="fa-solid fa-eye"></i>&nbsp;Zobrazit</a>&nbsp;
                                  <a href="/orders/delete/'.$order->id.'" class="delete btn btn-success btn-sm"><i class="fa-solid fa-trash-can"></i>&nbsp;Odstranit</a>';
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
        $client = Client::where('id', $request->clients)->first();

        $order = new Order();
        $order->client_id = $request->clients;
        $order->full_price = null;
        $order->note = $request->note;
        $order->day = $client->day;
        $order->date = $request->date;
        $order->save();

        $price = 0;

        foreach($request->product as $key => $product) {
            //dd(intval($request->product_price[$key]));
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->client_id = $request->clients;
            $order_item->item_id = $key;
            $order_item->quantity = $product;
            $order_item->price = floatval($request->product_price[$key]);
            $order_item->unit = "kg";
            $order_item->save();

            $price += $product * floatval($request->product_price[$key]);
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
        $order = Order::addSelect(['client' => Client::select('name')
                        ->whereColumn('id', 'orders.client_id')
                        ])->find($id);

        $order_items = OrderItem::addSelect(['product' => Product::select('name')
                        ->whereColumn('id', 'order_items.item_id')
                      ])->addSelect(['price' => Product::select('price')
                        ->whereColumn('id', 'order_items.item_id')
                      ])->where('order_id', $order->id)->get();

        return view('orders.edit')->with(['order' => $order, 'order_items' => $order_items]);
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
        $client = Client::where('id', $request->clients)->first();

        $order = Order::find($id);
        $order->note = $request->note;
        $order->day = $client->day;
        $order->save();

        $price = 0;

        $i = 0;
        foreach($request->product as $key => $product) {
            dd($request->product_id[$i]);
            $order_item = OrderItem::find($request->product_id[$i]);
            $order_item->order_id = $order->id;
            $order_item->item_id = $key;
            $order_item->quantity = $product;
            $order_item->unit = "kg";
            $order_item->save();

            $product_item = Product::where('id', $request->product_id[$i])->first();
            $price += $product * $product_item->price;

            $i++;
        }

        $order = Order::where('id', $order->id)->first();
        $order->full_price = $price;
        $order->save();

        return redirect('/orders?add_success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('/orders');
    }


    public function exportDayOrders($day) {

        $final_orders = [];

        if($day == 'Vše') {
            $clients = Client::get();
        } else {
            $clients = Client::where('day', $day)->get();
        }


        foreach($clients as $key => $client) {
            $final_orders[$key]['client'] = $client->name;
            $final_orders[$key]['email'] = $client->email;
            $final_orders[$key]['phone'] = $client->phone;
            $final_orders[$key]['address'] = $client->street." ".$client->street_number.", ".$client->city." ".$client->zip;
            $final_orders[$key]['note'] = $client->note;

            $orders = Order::where('client_id', $client->id)->get();
            if($orders) {
                foreach($orders as $key2 => $order) {
                    $final_orders[$key]['orders'][$key2]['price'] = $order->full_price;
                    $final_orders[$key]['orders'][$key2]['note'] = $order->note;

                    $order_items = OrderItem::where('order_id', $order->id)->get();
                    foreach($order_items as $key3 => $item) {
                        $product = Product::where('id', $item->item_id)->first();
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['product'] = $product->name;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['price_per_kg'] = $product->price;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['quantity'] = $item->quantity;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['full_price'] = $item->quantity * $product->price;
                    }
                }
            }
        }


        $data = [
            'day' => $day,
            'orders' => $final_orders,
        ];


        $pdf = PDF::loadView('pdfs.dayOrdersAllPDF', $data);

        return $pdf->stream("day_orders_".$day."_".time().".pdf");


    }
}
