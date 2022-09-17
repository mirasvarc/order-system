<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';


    public function getItemsSoldByMonths($product_id) {

        $items = DB::select(
            DB::raw(
                'SELECT oi.client_id, oi.order_id, oi.item_id, SUM(oi.quantity) as quantity, SUM(oi.price) as price, oi.unit, YEAR(oi.created_at) as year, MONTH(oi.created_at) as month, p.name
                FROM order_items oi 
                LEFT JOIN products p 
                ON (oi.item_id = p.id) 
                WHERE oi.item_id = '.$product_id.'
                GROUP BY month, year
                ORDER BY year DESC, month ASC
                '
            )
        );
        return $items;
    }

    public function getItemsSoldThisMonth() {
 
         $items = DB::select(
             DB::raw(
                 'SELECT oi.client_id, oi.order_id, oi.item_id, SUM(oi.quantity) as quantity, SUM(oi.price) as price, oi.unit, oi.created_at, p.name
                 FROM order_items oi 
                 LEFT JOIN products p 
                 ON (oi.item_id = p.id) 
                 WHERE YEAR(oi.created_at) = YEAR(CURRENT_DATE())
                 AND MONTH(oi.created_at) = MONTH(CURRENT_DATE())
                 GROUP BY oi.item_id
                 '
             )
         );
 
         return $items;
     }

    public function getItemsSoldLastMonth() {
       /* $result = OrderItem::selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->get();
*/

        $items = DB::select(
            DB::raw(
                'SELECT oi.client_id, oi.order_id, oi.item_id, SUM(oi.quantity) as quantity, SUM(oi.price) as price, oi.unit, oi.created_at, p.name
                FROM order_items oi 
                LEFT JOIN products p 
                ON (oi.item_id = p.id) 
                WHERE YEAR(oi.created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
                AND MONTH(oi.created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
                GROUP BY oi.item_id
                '
            )
        );

        return $items;
    }

    public function getItemsSoldByDate($date_from, $date_to) {
        
        $date_from = Carbon::parse($date_from)->toDateTimeString();
        $date_to = Carbon::parse($date_to)->toDatetimeString();
        
        $items = DB::select(
            DB::raw(
                'SELECT oi.client_id, oi.order_id, oi.item_id, SUM(oi.quantity) as quantity, SUM(oi.price) as price, oi.unit, oi.created_at, p.name
                FROM order_items oi 
                LEFT JOIN products p 
                ON (oi.item_id = p.id) 
                WHERE oi.created_at BETWEEN "'.$date_from.'" AND "'.$date_to.'" 
                GROUP BY oi.item_id'
            )
        );

        return $items;
    }
}
