<?php

namespace App\Filters;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderFilter extends ApiFilter{
    protected $columns = ['string' => [],'number'=>'order_date'];

    //custom query to get orders adding column amount, details and product data

    public function queryFullDataOrder(){

       // DB::statement("SET SQL_MODE=''"); //add this line or change in config/database.php mysql strict to false

        $orders = Order::with(['customer'=> function($cust){
                            $cust->select('id','name','email');
                    }])->with(['orderDetails' => function($query) {
                            $query->with(['product'=> function($qr){
                                $qr->select('id','name','price');
                            }])->select('id as detail_id','order_id','quantity','product_id');
                    }])->addSelect(['amount' => OrderDetail::join('products','order_details.product_id','=','products.id')
                            ->selectRaw('SUM(order_details.quantity * products.price)')
                            ->whereColumn('order_id','orders.id')])
                            ->get();

        return $orders;

    }
}
