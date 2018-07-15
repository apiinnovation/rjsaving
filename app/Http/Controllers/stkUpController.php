<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests;

use App\TStkTAddStock;
use App\Http\Requests\stkUpRequest;
use App\Http\Controllers\mainController;
use Auth;

class stkUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   
    
    public function index( $docno = null)
    {
        $main  = new mainController();
        $action = 'create';
        $res_cus ='';
        $qtybalance = 0;
        $amtbalance = 0;
        $amtbalance_txt = "";        
        $addamt_txt = "";
        $addsumamt_txt ="";
        $doc_date = $main->get_current_th();
        $doc_approvedate = $main->get_current_th();
                
        $sql = "SELECT TOP 1 a.*
                FROM TStkTAddStock a
                Where  a.XVAddDocNo = '$docno'
                ";
        $res_stk = DB::select($sql);
        
        if (!empty($docno) &&  empty($res_stk)){
            Alert::warning('ไม่พบรายการที่ค้นหา ', 'เกิดข้อผิดพลาด')->persistent('Close');
        }else{
            
            if (!empty($res_stk)){
                $res_cus = $main->get_data_cus( $res_stk[0]->XVCusCode);                
                
                $res_cus[0]->XITrnQty = number_format($res_cus[0]->XITrnQty);
                $res_stk[0]->XFAddAmount = $res_stk[0]->XIAddQty * 200;
                
                
                $qtybalance = number_format($res_stk[0]->XIAddQtyBalance,0);
                $amtbalance = number_format($res_stk[0]->XFAddAmtBalance,2);
                $amtbalance_txt = $main->thCurrency_decimal($res_stk[0]->XFAddAmtBalance);
                
                $addamt_txt = $main->thCurrency_decimal($res_stk[0]->XFAddAmount);
                $addsumamt_txt = $main->thCurrency_decimal($res_stk[0]->XFAddSumAmount);
                $action = 'edit';
                $doc_date = $main->chg_date_th($res_stk[0]->XDAddApproveDate);
                $doc_approvedate = $main->chg_date_th($res_stk[0]->XDAddDocDate);       
                //print $res_stk[0]->XVAddRemark;
            }
        }

        return view('stock.stkup',[
                                    'res_stk'=>$res_stk,
                                    'res_cus'=>$res_cus,
                                    'qtybalance' =>$qtybalance,
                                    'amtbalance'=>$amtbalance,
                                    'amtbalance_txt'=>$amtbalance_txt,
                                    'addamt_txt'=>$addamt_txt,
                                    'addsumamt_txt'=>$addsumamt_txt,
                                    'doc_date'=>$doc_date,
                                    'doc_approvedate'=>$doc_approvedate,
                                    'action'=>$action
                                    ]);        
        }
    
    
    public function get_customer( $cuscode )
    {
        
        $main  = new mainController();
        $qtybalance = 0;
        $amtbalance = 0;
        $amtbalance_txt = "";
        $doc_date = $main->get_current_th();
        $doc_approvedate = $main->get_current_th();
        
        $res = $main->get_data_cus($cuscode);
        //print $res[0]->XFCusSalary;
        if ($cuscode != null && empty($res)){
            Alert::warning('ไม่พบรายการที่ค้นหา ', 'เกิดข้อผิดพลาด')->persistent('Close');;
        }else{
            if (!empty($res)){
                $qtybalance = number_format($res[0]->XITrnQty);
                $amtbalance = number_format($res[0]->XFTrnAmount,2);
                $amtbalance_txt = $main->thCurrency_decimal($res[0]->XFTrnAmount);            
            }
        }

        return view('stock.stkup',['res_cus'=>$res,
                    'amtbalance_txt'=>$amtbalance_txt,
                    'qtybalance' =>$qtybalance,
                    'doc_date'=>$doc_date,
                    'doc_approvedate'=>$doc_approvedate,
                    'amtbalance'=>$amtbalance
                ]);
        
    }
    

    
    public function  main_list($cuscode = null){

        $clauses = [];
        if(isset($cuscodes)) {
            $clauses = array_merge($clauses,['XVCusCode' => $cuscode]);
        }        
        
         $res = DB::table('TStkTAddStock as a')
                 ->select('a.XVAddDocNo','a.XDAddDocDate', 
                            'a.XVCusCode',
                            DB::raw("CONCAT(XVCusFname,' ',XVCusLname) as XVCusName"),
                            'XVBchName','XVDivName','XVAddDocStatus','XBAddDocSend')
                 ->join('TStkMCustomer as b','a.XVCusCode','=','b.XVCusCode')
                 ->join('TComMBranch as c','b.XVBchCode','=','c.XVBchCode')
                 ->join('TComMDivision as d','b.XVDivCode','=','d.XVDivCode')
                 ->orderBy('XVAddDocNo', 'desc');//->toSql();
        // dd($res);

        if($cuscode != null){            
            $res = $res->where('a.XVCusCode', 'like', '%' .$cuscode. '%');    
        }
        
        $res = $res->paginate(12,array('XVAddDocNo'));

        return view('stock.stkup_main',['res_all'=>$res]);
    }

    public function save(Request  $request)
    {
        try{
            $main  = new mainController();
            $docno = "";

        switch($request->_action ){
            case 'create':

                
                $docno = $main->gen_docno('TStkTAddStock', 'XVAddDocNo', 'SA');
                DB::table('TStkTAddStock')->insert(
                [
                    'XVAddDocNo' => $docno, 
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVCusCode' => $request->XVCusCode,
                    'XVBchCode' => $request->XVBchCode,
                    'XDAddDocDate' => $main->chg_sqldate($request->XDAddDocDate),
                    'XDAddApproveDate' => $main->chg_sqldate($request->XDAddApproveDate),
                    'XIAddQtyBalance' => $main->chg_repnumber($request->XIAddQtyBalance),
                    'XFAddAmtBalance' => $main->chg_repnumber($request->XFAddAmtBalance),                    
                    'XIAddQty' => $main->chg_repnumber($request->XIAddQty),
                    'XFAddAmount' => $main->chg_repnumber($request->XFAddAmount) ,
                    'XIAddSumQty' => $main->chg_repnumber($request->XIAddSumQty),
                    'XFAddSumAmount' => $main->chg_repnumber($request->XFAddSumAmount) ,                    
                    'XVAddDocStatus' => $request->doc_status,
                    'XBAddDocSend' => $request->doc_send,
                    'XVAddRemark' => $request->XVAddRemark,
                    'XVWhoEdit' => Auth::user()->username,
                    'XVWhoCreate' => Auth::user()->username,
                    'XTWhenEdit' => date("Y-m-d H:i:s"),
                    'XTWhenCreate' => date("Y-m-d H:i:s")
                ]
                );
                Alert::success('บันทึกข้อมูลสำเร็จ');
                break;
            case 'edit':
                
               
                $docno = $request->XVAddDocNo;
                DB::table('TStkTAddStock')
                        ->where('XVAddDocNo',$docno)
                        ->update(
                    [                    
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVCusCode' => $request->XVCusCode,
                    'XVBchCode' => $request->XVBchCode,
                    'XDAddDocDate' => $main->chg_sqldate($request->XDAddDocDate),
                    'XDAddApproveDate' => $main->chg_sqldate($request->XDAddApproveDate),
                    'XIAddQtyBalance' => $main->chg_repnumber($request->XIAddQtyBalance),
                    'XFAddAmtBalance' => $main->chg_repnumber($request->XFAddAmtBalance),      
                    'XIAddQty' => $main->chg_repnumber($request->XIAddQty),
                    'XFAddAmount' => $main->chg_repnumber($request->XFAddAmount) ,
                    'XIAddSumQty' => $main->chg_repnumber($request->XIAddSumQty),
                    'XFAddSumAmount' => $main->chg_repnumber($request->XFAddSumAmount) ,                    
                    'XVAddDocStatus' => $request->doc_status,
                    'XBAddDocSend' => $request->doc_send,
                    'XVAddRemark' => $request->XVAddRemark,
                    'XVWhoEdit' => Auth::user()->username,
                    'XTWhenEdit' => date("Y-m-d H:i:s")
                    ]
                );
                break;   
        }
        
            if ($request->doc_status  == '2'){
               DB::table('TStkTTransaction')->insert(
               [
                   'XVTrnDocNo' => $docno, 
                   'XVEmpCode' => $request->XVEmpCode, 
                   'XVCusCode' => $request->XVCusCode,
                   'XVBchCode' => $request->XVBchCode,
                   'XVTrnDocType'=>'2',
                   'XITrnQty' => $main->chg_repnumber($request->XIAddQty),
                   'XFTrnAmount' => $main->chg_repnumber($request->XFAddAmount) ,
                   'XVWhoEdit' => Auth::user()->username,
                   'XVWhoCreate' => Auth::user()->username,
                   'XTWhenEdit' => date("Y-m-d H:i:s"),
                   'XTWhenCreate' => date("Y-m-d H:i:s")
               ]); 
            }
            
            if ($request->doc_status ==1 && $request->doc_send ==1){
                Alert::success('ส่งเพื่อรออนุมัติสำเร็จแล้ว');
            }else{                        
                Alert::success('บันทึกข้อมูลสำเร็จ');
            }
                         
        } catch (Exception $ex) {
            console.log($ex);
            Alert::warning('ไม่พบรายการที่ค้นหา ', 'เกิดข้อผิดพลาด')->persistent('Close');
        }
        
        return redirect('/stkup/'.$docno);

    }


}
