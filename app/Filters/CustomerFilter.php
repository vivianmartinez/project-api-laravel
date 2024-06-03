<?php

namespace App\Filters;


class CustomerFilter extends ApiFilter{

    protected $columns = [
        'string' => ['name','email','address','city','country'],
        'number' => ['postal_code']
    ];

}
