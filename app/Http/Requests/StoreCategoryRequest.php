<?php

namespace App\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
     public function rules(): array
     {
        return[
          'name' => 'required',
            'is_active'=>'required|integer|between:0,1',
            'order_id'=> 'required|numeric',
            'parent_id'=>'nullable|numeric'
        ];
     }
}

