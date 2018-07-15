<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTComMPrefixRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'XVPreCode'  => 'required|unique' ,
            'XVPreName' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'XVPreCode.required'    => 'กรุณากรอกรหัส',
            'XVPreCode.unique'    => 'รหัสนี้มีอยู่แล้ว',
            'XVPreName.required'  => 'กรุณากรอกคำนำหน้านามที่ต้องการ'
        ];
    }
}
