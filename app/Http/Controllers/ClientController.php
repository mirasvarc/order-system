<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use PDF;
use DataTables;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::All();

        return view('clients.index')->with(['clients' => $clients]);
    }

    public function getClients(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($client){
                    $actionBtn = '<a href="/clients/'.$client->id.'" class="edit btn btn-success btn-sm">Otevřít</a>
                                  <a href="/clients/edit/'.$client->id.'" class="edit btn btn-success btn-sm">Upravit</a>
                                 ';
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
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->street = $request->street;
        $client->street_number = $request->street_number;
        $client->city = $request->city;
        $client->zip = $request->zip;
        $client->country = $request->country;
        $client->note = $request->note;
        $client->day = $request->day;
        $client->save();

        return redirect('/clients?add_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        $orders = Order::where('client_id', $client->id)->get();

        return view('clients.detail')->with(['client' => $client, 'client_orders' => $orders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit')->with(['client' => $client]);
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
        $client = Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->street = $request->street;
        $client->street_number = $request->street_number;
        $client->city = $request->city;
        $client->zip = $request->zip;
        $client->country = $request->country;
        $client->note = $request->note;
        $client->day = $request->day;
        $client->save();

        return redirect('/clients?add_success');
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


    public function exportDayOrders($day, $id) {

        $client = Client::find($id);

        if($day == 'Vše') {
            $orders = Order::where('client_id', $client->id)->get();
        } else {
            $orders = Order::where('client_id', $client->id)->where('day', $day)->get();
        }


        $full_orders = [];

        foreach($orders as $key => $order) {
            $full_orders[$key]['order'] = $order;
            $full_orders[$key]['items'] = OrderItem::addSelect(['product' => Product::select('name')
                                            ->whereColumn('id', 'order_items.item_id')
                                        ])->addSelect(['price' => Product::select('price')
                                            ->whereColumn('id', 'order_items.item_id')
                                        ])->where('order_id', $order->id)->get();
        }

        dd($full_orders);

        $data = [
            'day' => $day,
            'client' => $client,
            'orders' => $full_orders,
        ];


        $pdf = PDF::loadView('pdfs.DayOrdersPDF', $data);

        return $pdf->stream("day_orders_".$day."_".time().".pdf");


    }
}
