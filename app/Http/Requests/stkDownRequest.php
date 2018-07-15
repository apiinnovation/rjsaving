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
        'XIDowQty' => 'required'
        ];
    }
    
    public function messages() {
     return [
        //'XVAddDocNo.required' => 'กรุณากรอกรหัส',
        'XIDowQty.required' => 'กรุณากรอกจำนวนหุ้นที่ต้องการลด',
        ];
     }    
}
