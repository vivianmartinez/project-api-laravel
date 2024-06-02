<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{
    protected $columns;
    protected $operators;

    public function __construct()
    {
        $this->operators = [
            'string'  =>[
                'equal'         => '=',
                'contain'       => 'LIKE'],
            'number' =>[
                'equal'         => '=',
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
            $key = array_key_first($content);
            $value = $content[$key];
            //verify column exists
            if(! in_array($column,$this->columns['string']) && !in_array($column,$this->columns['number'])){
                $column = null;
            }
            //verify operator
            $operator = array_key_exists($key,$this->operators['string']) ? ['string' => $this->operators['string'][$key]] : [];
            $operator = array_key_exists($key,$this->operators['number']) ? ['number' => $this->operators['number'][$key]] : [];

            if(! empty($operator) && $column !== null){
                if(in_array($column,$this->columns['string']) && isset($operator['string'])){
                    $value = $key == 'equal' ? $content[$key] : '%'.$content[$key].'%';
                    $query[] = [$column,$operator['string'],$value];
                }elseif(in_array($column,$this->columns['number']) && isset($operator['number']) ){
                    $query[] = [$column,$operator['number'],$value];
                }else{
                    $query = ['error','Invalid params.'];
                }
            }else{
                $query = ['error','Invalid params.'];
            }
        }
        print_r($query);
        exit();
    }

}
