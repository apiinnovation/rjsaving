<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BranchRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
        'XVBchName' => 'required',
        'XVBchAddress' => 'required'
        ];
    }
    
    public function messages() {
     return [
        'XVBchName.required' => 'กรุณากรอกชื่อสาขา',
        'XVBchAddress.required' => 'กรุณากรอกที่อยู่สาขา',
        ];
     }    
}
