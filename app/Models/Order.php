<?php

namespace App\Models;

use App\Models\Client;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getDayOrders($day, $date = null) {
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
            $final_orders[$key]['ic'] = $client->ic;
            $final_orders[$key]['dic'] = $client->dic;
            $final_orders[$key]['address'] = $client->street." ".$client->street_number.", ".$client->city." ".$client->zip;
            $final_orders[$key]['note'] = $client->note;

            
            if($date) {
                $orders = Order::where('client_id', $client->id)->where('date', $date)->get();
            } else {
                $orders = Order::where('client_id', $client->id)->get();
            }
            
                
            if($orders) {
                foreach($orders as $key2 => $order) {
                    $final_orders[$key]['orders'][$key2]['price'] = $order->full_price;
                    $final_orders[$key]['orders'][$key2]['note'] = $order->note;

                    $order_items = OrderItem::where('order_id', $order->id)->get();
                    foreach($order_items as $key3 => $item) {
                        if($item->quantity > 0) {
                            $product = Product::where('id', $item->item_id)->first();
                            $final_orders[$key]['orders'][$key2]['items'][$key3]['product_id'] = $product->id;
                            $final_orders[$key]['orders'][$key2]['items'][$key3]['product'] = $product->name;
                            $final_orders[$key]['orders'][$key2]['items'][$key3]['price_per_kg'] = $item->price;
                            $final_orders[$key]['orders'][$key2]['items'][$key3]['quantity'] = $item->quantity;
                            $final_orders[$key]['orders'][$key2]['items'][$key3]['full_price'] = $item->quantity * $item->price;
                            $final_orders[$key]['orders'][$key2]['items'][$key3]['price_vat'] = ($item->quantity * $item->price) * 1.15;
                        }
                    }
                }
            }
        }
        
        return $final_orders;
    }


}
