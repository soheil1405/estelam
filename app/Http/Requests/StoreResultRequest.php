<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
{
     public function rules()
    {
        return [
            'nationalCode'=>'required|digits:10' ,
            'resultPersian'=>'required' ,
            'resultEnglish'=>'nullable'
        ];
    }
}
