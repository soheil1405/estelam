<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitFormReq extends FormRequest
{

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required' ,
            'family'=>'required',
            'father'=>'required',
            'email'=>'required|email' ,
            'nationalCode'=>'required|digits:10',
            'numberId'=>'required|numeric',
            'serialId'=>'required|digits:6',
            'day'=>'required|numeric|min:1|max:31',
            'month'=>'required|max:12|min:1',
            'year'=>'required|numeric',
        ];
    }
}
