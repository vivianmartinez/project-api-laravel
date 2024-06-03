<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{
    protected $columns;
    protected $operators;

    public function __construct()
    {
        $this->operators = [
            'all'       =>  ['equal'    => '='],
            'string'    =>  ['contain'  => 'LIKE'],
            'number'    =>  [
                'less'          => '<',
                'greater'       => '>',
                'less_equal'    => '<=',
                'greater_equal' => '>=',
                'not_equal'     => '!='
            ]
        ];
    }

    public function generateEloquentQuery(Request $request){
        $query = [];
        $requestQuery = $request->query();

        foreach($requestQuery as $column => $content){
            //get the operator
            if( ! is_array($content)){
                continue;
            }
            $key = array_key_first($content);
            $value = $content[$key];
            //verify column exists
            if(! in_array($column,$this->columns['string']) && !in_array($column,$this->columns['number'])){
                $column = null;
            }
            //verify operator exists
            $operator = array_key_exists($key,$this->operators['all']) ? ['all' => $this->operators['all'][$key]] : [];
            $operator = array_key_exists($key,$this->operators['string']) ? ['string' => $this->operators['string'][$key]] : $operator;
            $operator = array_key_exists($key,$this->operators['number']) ? ['number' => $this->operators['number'][$key]] : $operator;

            if(!empty($operator) && $column !== null){
                //validate operator for strings with column string and operator for numbers
                $op = null;
                if(in_array($column,$this->columns['string']) && (isset($operator['string']) || isset($operator['all']))){
                    $op = $operator['string'] ?? $operator['all'];
                    $value = $op !== 'LIKE' ? $content[$key] : '%'.$content[$key].'%';
                }elseif(in_array($column,$this->columns['number']) && (isset($operator['number']) || isset($operator['all']))){
                    $op = $operator['number'] ?? $operator['all'];
                }
                if($op !== null) $query[] = [$column,$op,$value];
                else $query = ['error' => 'Invalid request.'];
            }else{
                $query = ['error' => 'Invalid request.'];
            }
        }

       return $query;
    }

    public function generateItemsJoin(){

    }

}
