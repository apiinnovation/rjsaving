<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [        
            'XVUserFName' => 'required',
            'XVUserLName' => 'required',
            'XVEmpCode' => 'required',
            'XVBchCodeRef' => 'required',
            'username' => 'required'         
        ];
    }
    
    public function messages() {
     return [        
            'XVUserFName.required' => 'กรุณากรอกชื่อ',
            'XVUserLName.required' => 'กรุณากรอกนามสกุล',
            'XVEmpCode.required' => 'กรุณากรอกรหัสพนักงาน',
            'XVBchCodeRef.required' => 'กรุณาเลือกสาขาที่ดูแล',
            'username.required' => 'กรุณากรอก User Name',         
        ];
     }    
}
