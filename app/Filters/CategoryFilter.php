<?php

namespace App\Filters;

use Illuminate\Http\Request;

class CategoryFilter extends ApiFilter{

    protected $columns = [
        'string' => ['name','description'],
        'number' => []
    ];
}
