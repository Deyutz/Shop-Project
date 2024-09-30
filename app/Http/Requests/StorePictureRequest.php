<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StorePictureRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id'=> 'required|numeric',
        ];
    }
}