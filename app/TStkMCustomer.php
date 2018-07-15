<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TStkMCustomer extends Model
{
    protected $table ='TStkMCustomer';
    //protected $fillable='[XVBchCode','XVBchName','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate]';    
//    'XVStkDocNo'
      protected $fillable=['XVCusCode'
      ,'XVBchCode'
      ,'XVCusStaff'   
      ,'XVDivCode'
      ,'XVCusStatus'
      ,'XVPreCode'
      ,'XVPreName'
      ,'XVCusFname'
      ,'XVCusLname'
      ,'XDCusBdate'
      ,'XVCusId'
      ,'XDCusDateIn'
      ,'XDCusBdateWork'
      ,'XVEmpCode'
      ,'XFCusSalary'
      ,'XFCusWelfare'
      ,'XVCusAddress'
      ,'XVCusTelWork'
      ,'XVCusTelPrivate'
      ,'XVCusNameBank'
      ,'XVCusBankId'
      ,'XVCusMarriage'
      ,'XVCusPrefixMarriage'
      ,'XVCusFnameMarriage'
      ,'XVCusLnameMarriage'
      ,'XVCusAddressMarriage'
      ,'XVCusDetailAddMarriage'    
      ,'XVCusTelMarriage'
      ,'XVCusPrefixReference'
      ,'XVCusFnameReference'
      ,'XVCusLnameReference'
      ,'XVCusConnectReference'    
      ,'XVCusTelReference'
      ,'XICusBeginQtyStock'
      ,'XFCusBeginsavings'
      ,'XVCusPrefixBeneficiary'
      ,'XVCusFnameBeneficiary'
      ,'XVCusLnameBeneficiary'
      ,'XVCusConnectBeneficiary'    
      ,'XVWhoCreate'
      ,'XTWhenCreate'
      ,'XVWhoEdit'
      ,'XTWhenEdit'
      ,'XVCusDoc'
      ,'XVCusSend' 
   ];
}
