<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class TStkTAddStock extends Model
{
	protected $table ='TStkTAddStock';
	protected $fillable=['XVAddDocNo', 'XVEmpCode', 'XVCusCode', 'XVBchCode', 'XDAddDocDate', 'XDAddApproveDate', 'XIAddQtyBalance', 'XIAddQty', 'XFAddAmount', 'XIAddSumQty', 'XFAddSumAmount', 'XVAddDocStatus', 'XBAddDocSend', 'XVWhoCreate', 'XTWhenCreate', 'XVWhoEdit', 'XTWhenEdit'];
}
