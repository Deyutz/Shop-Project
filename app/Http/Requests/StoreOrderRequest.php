<?php

namespace App\Http\Resources; 

use Illuminate\Foundation\Http\FormRequest;


class StoreOrderRequest extends FormRequest
{
     public function rules(): array
     {
        return[
            'order_id'=>'numeric|nullable',
            '*.product_id'=>'required|exists:product,id',
            '*.quantity'=>'required|numeric'
        ];
     }
}
