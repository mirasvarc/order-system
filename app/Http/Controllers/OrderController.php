<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\DeliveryHistory;
use App\Models\Product;
use App\Models\OrderItem;
use DataTables;
use PDF;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\String\b;

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
            //$data = Order::latest()->get();
            $data = Order::addSelect(['name' => Client::select('name')
                             ->whereColumn('id', 'orders.client_id')
                         ])->addSelect(['client_day' => Client::select('day')
                             ->whereColumn('id', 'orders.client_id')
                         ])->orderBy('id', 'DESC')->get();
    
           

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($order){
                    $actionBtn = '<a href="/orders/bill/'.$order->id.'" class="edit btn btn-success btn-sm"><i class="fa-solid fa-arrow-up-right-from-square"></i>&nbsp;Dodací list</a>&nbsp;
                                  <a href="/orders/'.$order->id.'" class="edit btn btn-success btn-sm"><i class="fa-solid fa-eye"></i>&nbsp;Zobrazit</a>&nbsp;
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
        $products = Product::where('deleted', 0)->get();
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
        $order->currency = $request->currency;
        $order->note = $request->note;
        
        if(isset($request->day) && $request->day != "") {
            $order->day = $request->day;
        } else {
            $order->day = $client->day;
        }
       
        $year = Carbon::now()->year;
        DB::table('order_numbers')->where('year', $year)->increment('count');

        $order->number = DB::table('order_numbers')->where('year', $year)->first()->count;

        $order->date = $request->date;
        $order->save();

        $price = 0;

       

        foreach($request->product as $key => $product) {
            if($product > 0 && $product != null) {
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

        $products = Product::get();

        return view('orders.detail')->with(['order' => $order, 'order_items' => $order_items, 'all_products' => $products]);
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
    
        $order = Order::find($id);

        $client = Client::where('id', $order->client_id)->first();

        $order->note = $request->note;
        if(isset($request->day) && $request->day != "") {
            $order->day = $request->day;
        } else {
            $order->day = $client->day;
        }
        $order->date = $request->date;
        $order->currency = $request->currency;
        $order->save();

        return redirect('/orders/'.$id.'?add_success');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editItem($id)
    {
        $item = OrderItem::find($id);
        $product = Product::find($item->item_id);

        return view('orders.item_edit')->with(['item' => $item, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateItem(Request $request, $id)
    {
    
        $item = OrderItem::find($id);

        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->save();

        $this->calculateOrderPrice($item->order_id);

        return redirect('/orders/'.$item->order_id.'?add_success');
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

    
    public function showExports() {
        $orders = Order::All();

        $orders_count = [
            "monday" => Order::where('day', 'Pondělí')->count(),
            "tuesday" => Order::where('day', 'Úterý')->count(),
            "wednesday" => Order::where('day', 'Středa')->count(),
            "thursday" => Order::where('day', 'Čtvrtek')->count(),
            "friday" => Order::where('day', 'Pátek')->count(),
            "all" => Order::count(),
        ];
       

        return view('orders.exports')->with(['orders' => $orders, 'orders_count' => $orders_count]);
    }


    public function exportDayOrders($day) {

        $order = new Order();
        $final_orders = $order->getDayOrders($day);

        $data = [
            'day' => $day,
            'orders' => $final_orders,
        ];


        $pdf = PDF::loadView('pdfs.dayOrdersAllPDF', $data);

        return $pdf->stream("day_orders_".$day."_".time().".pdf");


    }

    public function exportCustom(Request $request) {
        $final_orders = [];

        if($request->export_day_select == 'Vše') {
            $clients = Client::get();
        } else {
            $clients = Client::where('day', $request->export_day_select)->get();
        }



        foreach($clients as $key => $client) {
            $final_orders[$key]['client'] = $client->name;
            $final_orders[$key]['email'] = $client->email;
            $final_orders[$key]['phone'] = $client->phone;
            $final_orders[$key]['address'] = $client->street." ".$client->street_number.", ".$client->city." ".$client->zip;
            $final_orders[$key]['note'] = $client->note;

            $orders = Order::where('client_id', $client->id)->whereDate('date', '>=', $request->date_from)->whereDate('date', '<=', $request->date_to)->get();
            if($orders) {
                foreach($orders as $key2 => $order) {
                    $final_orders[$key]['orders'][$key2]['price'] = $order->full_price;
                    $final_orders[$key]['orders'][$key2]['currency'] = $order->currency;
                    $final_orders[$key]['orders'][$key2]['note'] = $order->note;

                    $order_items = OrderItem::where('order_id', $order->id)->get();
                    foreach($order_items as $key3 => $item) {
                        $product = Product::where('id', $item->item_id)->first();
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['product'] = $product->name;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['price_per_kg'] = $item->price;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['quantity'] = $item->quantity;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['full_price'] = $item->quantity * $item->price;
                        $final_orders[$key]['orders'][$key2]['items'][$key3]['price_vat'] = ($item->quantity * $item->price) * 1.15;
                    }
                }
            }
        }


        $data = [
            'day' => $request->export_day_select,
            'orders' => $final_orders,
        ];


        $pdf = PDF::loadView('pdfs.dayOrdersAllPDF', $data);

        return $pdf->stream("day_orders_".$request->export_day_select."_".time().".pdf");
    }


    public function calculateOrderPrice($order_id) {
        $order = Order::find($order_id);
        $order_items = OrderItem::where('order_id', $order_id)->get();

        $price = 0;

        foreach($order_items as $item) {
            $price += ($item->price * $item->quantity);
        }

        $order->full_price = $price;
        $order->save();
    }

    public function createBill($id) {

        $order = Order::find($id);
        $order_items = OrderItem::addSelect(['product' => Product::select('name')
                                  ->whereColumn('id', 'order_items.item_id')
                                ])->where('order_id', $order->id)
                                ->where('quantity', '>', 0)
                                ->get();
        $client = Client::find($order->client_id);

        $full_price = [
            'price' => 0,
            'price_vat' => 0
        ];

        foreach($order_items as $item) {
            $full_price['price'] += $item->price * $item->quantity;
            $full_price['price_vat'] += ($item->price * $item->quantity) * 1.15;
        }

        $data = [
            'client' => $client,
            'order' => $order,
            'order_items' => $order_items,
            'full_price' => $full_price
        ];
        
        $pdf = PDF::loadView('pdfs.BillPDF', $data);

        return $pdf->stream("dodaci_list_".time().".pdf");
    }

    public function createDayBills($day) {


        $order = new Order();
        $final_orders = $order->getDayOrders($day);
        

        $data = [
            'final_orders' => $final_orders,
        ];
        
        $pdf = PDF::loadView('pdfs.DayBillPDF', $data);

        return $pdf->stream("dodaci_list_".time().".pdf");
    }

    /**
     * Create custom bills for given date
     */
    public function exportCustomBill(Request $request) {

        $order = new Order();
        $final_orders = $order->getDayOrders($request->export_day_select, $request->export_date_select);
       
        $data = [
            'final_orders' => $final_orders,
        ];
   
        $pdf = PDF::loadView('pdfs.DayBillPDF', $data);

        return $pdf->stream("dodaci_list_".time().".pdf");
    }

    /**
     * Create export with names, adresses and products for dirver without selection
     */
    public function exportForDriver(Request $request) {
        $order = new Order();
        $final_orders = $order->getDayOrders($request->export_day_select, $request->export_date_select);

        $orders = Order::where('date', $request->export_date_select)->get();
        
        $data = [
            'final_orders' => $final_orders,
            'day' => $request->export_day_select,
            'date' => $request->export_date_select,
        ];
        
        $pdf = PDF::loadView('pdfs.DaySumPDF', $data);

        return $pdf->stream("dodaci_list_".time().".pdf");

    }
    

    public function addProductToOrder(Request $request) {

        $client = Client::where('name', $request->client)->first();

        $order_item = new OrderItem();
        $order_item->order_id = $request->order_id;
        $order_item->client_id = $client->id;
        $order_item->item_id = $request->product;
        $order_item->quantity = $request->quantity;
        $order_item->price = $request->price;
        $order_item->unit = "kg";
        $order_item->save();

        $order = Order::find($request->order_id);
        $full_price = $order->full_price + (floatval($request->quantity * $request->price));
        $order->full_price = $full_price;
        $order->save();

        return redirect()->back();

    }

    public function deleteItem($id) {
        $item = OrderItem::find($id);
        $item_id = $item->order_id;
    
        $item->delete();

        $this->calculateOrderPrice($item_id);

        return redirect()->back();
    }

    public function showCarSelect(Request $request) {
        $order = new Order();
        
        $orders = $order->getOrdersByDate($request->export_date_select);
        
        return view('orders.car_select', compact('orders'));
    }

    /**
     * Create export with names, adresses and products for dirver with selection
     */
    public function createBillWithSelection(Request $request) {
        $orders[1] = [];
        $orders[2] = [];
        $orders[3] = [];
        $orders[4] = [];
        $orders[5] = [];
        $orders[6] = [];

        foreach($request->order as $key => $order) {
            if($order == "1") {
                $orders[1][] = $key;
            } else if($order == "2") {
                $orders[2][] = $key;
            } else if($order == "3") {
                $orders[3][] = $key;
            } else if($order == "4") {
                $orders[4][] = $key;
            } else if($order == "5") {
                $orders[5][] = $key;
            } else if($order == "6") {
                $orders[6][] = $key;
            }
        }
       
       
        $tmp = new Order();
        $final_orders = $tmp->getDayOrdersWithSelection($orders);

        if(!isset($final_orders[1])) {
            $final_orders[1] = [];
        }
        if(!isset($final_orders[2])) {
            $final_orders[2] = [];
        }
        if(!isset($final_orders[3])) {
            $final_orders[3] = [];
        }
        if(!isset($final_orders[4])) {
            $final_orders[4] = [];
        }
        if(!isset($final_orders[5])) {
            $final_orders[5] = [];
        }
        if(!isset($final_orders[6])) {
            $final_orders[6] = [];
        }

        $data = [
            'final_orders_1' => $final_orders[1],
            'final_orders_2' => $final_orders[2],
            'final_orders_3' => $final_orders[3],
            'final_orders_4' => $final_orders[4],
            'final_orders_5' => $final_orders[5],
            'final_orders_6' => $final_orders[6]
        ];

        $data = [
            'final_orders' => $final_orders,
        ];

        $pdf = PDF::loadView('pdfs.DaySumSelectPDF', $data);

        return $pdf->stream("dodaci_list_".time().".pdf");
    }


    public function showDeliveryHistory() {
        return view('orders.delivery_history');
    }


    public function getDeliveryHistory(Request $request) {

        if ($request->ajax()) {
            $delivery_history = DeliveryHistory::leftJoin('orders', 'orders.id', '=', 'delivery_history.order_id')
                                                ->leftJoin('client', 'client.id', '=', 'orders.client_id')
                                                ->get();
            return Datatables::of($delivery_history)
                ->addIndexColumn()
                ->make(true);
        }


    }
    
   

}
