<?php

namespace App\Filters;


class ProductFilter extends ApiFilter{

    protected $params = [
        'string' => ['name','description'],
        'number' => ['category_id','price']
    ];
}
