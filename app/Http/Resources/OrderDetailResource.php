<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id'  => $this->product_id,
            'quantity'    => $this->quantity,
            'product'     => $this->load(['product'=> function($query){
                $query->select('id','name','price');
            }])->setHidden(['id','order_id','product_id','quantity','created_at','updated_at'])['product'],
        ];
    }
}
