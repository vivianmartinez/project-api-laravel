<?php

namespace App\Filters;

class OrderFilter extends ApiFilter{
    protected $columns = ['string' => [],'number'=>'order_date'];
}
