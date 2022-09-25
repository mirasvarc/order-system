<?php

namespace App\Models;

use App\Models\Client;
use App\Models\OrderItem;
use App\Models\Product;
use DB;
use Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:i',
    ];


    public function getOrders() {
        return Order::get();
    }

    /**
     * Get all clients with their orders for given day and date for export
     * @param day selected day
     * @param date selected date
     * @return final_orders array of clients with their orders
     */
    public function getDayOrders($day, $date = null) {
        $final_orders = [];

        //if($day == 'Vše') {
            $clients = Client::get();
        //} else {
          //  $clients = Client::where('day', $day)->get();
       // }


        foreach($clients as $key => $client) {
            if(Order::where('client_id', $client->id)->first()) { // check if client has any order for given day
                $final_orders[$key]['client_id'] = $client->id;
                $final_orders[$key]['client'] = $client->name;
                $final_orders[$key]['email'] = $client->email;
                $final_orders[$key]['phone'] = $client->phone;
                $final_orders[$key]['ic'] = $client->ic;
                $final_orders[$key]['dic'] = $client->dic;
                $final_orders[$key]['address'] = $client->street." ".$client->street_number.", ".$client->city." ".$client->zip;
                $final_orders[$key]['note'] = $client->note;

                
                if($date) {
                    $orders = Order::where('client_id', $client->id)->where('date', $date)->where('day', $day)->get();
                } else {
                    $orders = Order::where('client_id', $client->id)->where('day', $day)->get();
                }
                
                    
                if($orders) {
                    foreach($orders as $key2 => $order) {
                        $final_orders[$key]['orders'][$key2]['price'] = $order->full_price;
                        $final_orders[$key]['orders'][$key2]['currency'] = $order->currency;
                        $final_orders[$key]['orders'][$key2]['note'] = $order->note;
                        $final_orders[$key]['orders'][$key2]['date'] = $order->date;
                        $final_orders[$key]['note2'] = $order->note;

                        $order_items = OrderItem::where('order_id', $order->id)->get();
                        foreach($order_items as $key3 => $item) {
                            if($item->quantity > 0) { // add item only if its quantity is bigger than 0
                                $product = Product::where('id', $item->item_id)->first();
                                $final_orders[$key]['orders'][$key2]['items'][$key3]['product_id'] = $product->id;
                                $final_orders[$key]['orders'][$key2]['items'][$key3]['product'] = $product->name;
                                $final_orders[$key]['orders'][$key2]['items'][$key3]['price_per_kg'] = $item->price;
                                $final_orders[$key]['orders'][$key2]['items'][$key3]['quantity'] = $item->quantity;
                                $final_orders[$key]['orders'][$key2]['items'][$key3]['full_price'] = $item->quantity * $item->price;
                                $final_orders[$key]['orders'][$key2]['items'][$key3]['price_vat'] = ($item->quantity * $item->price) * 1.15; // calculate price with tax
                            }
                        }
                    }
                }
            }
        }
       
        return $final_orders;
        
    }


    public function getOrdersByDate($date) {
        $orders = DB::select(
            DB::raw(
                'SELECT o.id, c.name, c.street, c.street_number, c.city, c.zip FROM orders o LEFT JOIN client c ON (o.client_id = c.id) WHERE date = "'.$date.'"'
            )
        );
        
        return $orders;
    }




    /**
     * Get all clients with their orders for given day and date for export
     * @param day selected day
     * @param date selected date
     * @return final_orders array of clients with their orders
     */
    public function getDayOrdersWithSelection($orders) {
        
        $final_orders = [];
        
        $clients = Client::get();
   
        foreach($orders as $keyX => $order_group) {
            
            foreach($order_group as $key => $o) {
                $order = Order::where('id', $o)->first();
                $client = Client::where('id', $order->client_id)->first();
                $tmp_note = null;
                $tmp_note = $tmp_note . $order->note;
                
                $final_orders[$keyX][$key]['client_id'] = $client->id;
                $final_orders[$keyX][$key]['client'] = $client->name;
                $final_orders[$keyX][$key]['email'] = $client->email;
                $final_orders[$keyX][$key]['phone'] = $client->phone;
                $final_orders[$keyX][$key]['ic'] = $client->ic;
                $final_orders[$keyX][$key]['dic'] = $client->dic;
                $final_orders[$keyX][$key]['address'] = $client->street." ".$client->street_number.", ".$client->city." ".$client->zip;
                $final_orders[$keyX][$key]['note'] = $client->note;
                $final_orders[$keyX][$key]['order']['price'] = $order->full_price;
                $final_orders[$keyX][$key]['order']['currency'] = $order->currency;
                $final_orders[$keyX][$key]['order']['note'] = $client->note;
                $final_orders[$keyX][$key]['note2'] = $tmp_note;
                $final_orders[$keyX][$key]['order']['date'] = $order->date;

                $order_items = OrderItem::where('order_id', $order->id)->get();
                foreach($order_items as $key3 => $item) {
                    if($item->quantity > 0) { // add item only if its quantity is bigger than 0
                        $product = Product::where('id', $item->item_id)->first();
                        $final_orders[$keyX][$key]['order']['items'][$key3]['product_id'] = $product->id;
                        $final_orders[$keyX][$key]['order']['items'][$key3]['product'] = $product->name;
                        $final_orders[$keyX][$key]['order']['items'][$key3]['price_per_kg'] = $item->price;
                        $final_orders[$keyX][$key]['order']['items'][$key3]['quantity'] = $item->quantity;
                        $final_orders[$keyX][$key]['order']['items'][$key3]['full_price'] = $item->quantity * $item->price;
                        $final_orders[$keyX][$key]['order']['items'][$key3]['price_vat'] = ($item->quantity * $item->price) * 1.15; // calculate price with tax
                    }
                }
            }
        }

        return $final_orders;
        
    }


    public function getOrdersPriceByDays() {
        $orders_czk = DB::select(
            DB::raw(
                'SELECT date, SUM(full_price) as total FROM orders WHERE currency = "CZK" GROUP BY date'
            )
        );

        $orders_eur = DB::select(
            DB::raw(
                'SELECT date, SUM(full_price) as total FROM orders WHERE currency = "EUR" GROUP BY date'
            )
        );
        

        $orders = [
            $orders_czk,
            $orders_eur,
        ];

        return $orders;
    }

    public function getSoldItemsByDays() {
        $orders = DB::select(
            DB::raw(
                'SELECT p.name, oi.quantity, o.date, SUM(o.full_price) as total  FROM orders o LEFT JOIN order_items oi ON (o.id = oi.order_id) LEFT JOIN products p ON (oi.item_id = p.id) GROUP BY o.date, p.name, oi.quantity'
            )
        );

        return $orders;
    }

    public function getSalesByDate($date_from, $date_to) {
        
        $date_from = Carbon::parse($date_from)->toDateTimeString();
        $date_to = Carbon::parse($date_to)->toDatetimeString();
        

        $orders_czk = DB::select(
            DB::raw(
                'SELECT SUM(full_price) as total 
                FROM orders 
                WHERE currency = "CZK" 
                AND created_at BETWEEN "'.$date_from.'" AND "'.$date_to.'"'
            )
        );

        $orders_eur = DB::select(
            DB::raw(
                'SELECT SUM(full_price) as total 
                FROM orders 
                WHERE currency = "EUR" 
                AND created_at BETWEEN "'.$date_from.'" AND "'.$date_to.'"'
            )
        );

      /*  $orders = DB::select(
            DB::raw(
                'SELECT oi.client_id, oi.order_id, oi.item_id, SUM(oi.quantity) as quantity, SUM(oi.price) as price, oi.unit, oi.created_at, p.name
                FROM order_items oi 
                LEFT JOIN products p 
                ON (oi.item_id = p.id) 
                WHERE oi.created_at BETWEEN "'.$date_from.'" AND "'.$date_to.'" 
                GROUP BY oi.item_id'
            )
        );*/

        $orders = [
            $orders_czk,
            $orders_eur,
        ];
     
        return $orders;
    }


}
