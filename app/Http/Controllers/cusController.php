<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests;

use App\TStkTAddStock;
use App\Http\Requests\stkUpRequest;
use Auth;

class cusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }       
    public function findcus($url_return,$cuscode = null)
    {
       $sql = "SELECT  a.XVCusCode,XVEmpCode,XVCusFname +' ' + XVCusLname as XVCusName ,XVBchName,XVDivName,XITrnQty,XFTrnAmount
                FROM [dbo].[TStkMCustomer] a
                INNER JOIN [dbo].[TComMBranch] b ON a.XVBchCode = b.XVBchCode
                INNER JOIN [dbo].[TComMDivision] c ON a.XVDivCode = c.XVDivCode
                INNER JOIN (SELECT XVCusCode, SUM(XITrnQty) as XITrnQty, SUM(XFTrnAmount) XFTrnAmount  
                            FROM TStkTTransaction
                            GROUP BY XVCusCode) d ON a.XVCusCode = d.XVCusCode
                Where XVCusStatus = '2'
                    AND  a.XVBchCode IN ((SELECT e.XVBchCode FROM TComMUserBranch e Where e.username = '".Auth::user()->username."' ))
                Order By a.XVBchCode ,a.XVEmpCode
                ";

        if ($cuscode != null){
         $sql .= " AND a.XVCusCode = '$cuscode'";
        }
        $res = DB::select($sql);
        
        if (empty($res)){
            Alert::warning('ไม่พบรายการที่ค้นหา ', 'เกิดข้อผิดพลาด')->persistent('Close');;
        }
        
       return view('main.find-cus',['res_all'=>$res,
           'url_return'=>$url_return]);
    }
    

    
}
