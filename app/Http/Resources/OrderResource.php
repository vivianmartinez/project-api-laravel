<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'order_date' => $this->order_date,
            'amount'     => OrderDetail::join('products', 'order_details.product_id','=','products.id')
                            ->selectRaw('SUM(order_details.quantity * products.price) as amount')
                            ->where('order_id','=',$this->id)->get()[0]['amount'],
            'details'    => OrderDetailResource::collection($this->whenLoaded('orderDetails'))
        ];
    }
}
