<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class stkUpRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
        //'XVAddDocNo' => 'required',
        'XIAddQty' => 'required'
        ];
    }
    
    public function messages() {
     return [
        //'XVAddDocNo.required' => 'กรุณากรอกรหัส',
        'XIAddQty.required' => 'กรุณากรอกจำนวนหุ้นที่ต้องการเพิ่ม',
        ];
     }    
}
