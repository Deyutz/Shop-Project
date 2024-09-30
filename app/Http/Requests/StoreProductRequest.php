<?php

namespace App\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;


class StoreProductRequest extends FormRequest
{
     public function rules(): array
     {
        return[
            'name' => 'required', 
            'price' => 'required|numeric', 
            'description' => 'string|nullable', 
            'category_id'=> 'required|numeric|exists:categories,id',
            'stock'=>'integer|nullable'
        ];
     }
}

