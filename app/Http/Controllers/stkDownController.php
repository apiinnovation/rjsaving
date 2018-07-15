<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests;

use App\TStkTDownStock;
use App\Http\Requests\stkDownRequest;
use App\Http\Controllers\mainController;
use Auth;

class stkDownController extends Controller
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
                FROM TStkTDownStock a
                Where  a.XVDowDocNo = '$docno'
                ";
        $res_stk = DB::select($sql);
        
        if (!empty($docno) &&  empty($res_stk)){
            Alert::warning('ไม่พบรายการที่ค้นหา ', 'เกิดข้อผิดพลาด')->persistent('Close');
        }else{
            
            if (!empty($res_stk)){
                $res_cus = $main->get_data_cus( $res_stk[0]->XVCusCode);                
                
                $res_cus[0]->XITrnQty = number_format($res_cus[0]->XITrnQty);
                $res_stk[0]->XFDowAmount = $res_stk[0]->XIDowQty * 200;
                
                
                $qtybalance = number_format($res_stk[0]->XIDowQtyBalance,0);
                $amtbalance = number_format($res_stk[0]->XFDowAmtBalance,2);
                $amtbalance_txt = $main->thCurrency_decimal($res_stk[0]->XFDowAmtBalance);
                
                $addamt_txt = $main->thCurrency_decimal($res_stk[0]->XFDowAmount);
                $addsumamt_txt = $main->thCurrency_decimal($res_stk[0]->XFDowSumAmount);
                $action = 'edit';
                $doc_date = $main->chg_date_th($res_stk[0]->XDDowApproveDate);
                $doc_approvedate = $main->chg_date_th($res_stk[0]->XDDowDocDate);                
            }
        }
        
        
        $data = [
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
                ];

        return view('stock.stkdown',$data);        
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
        $res_down = $main->get_data_down($cuscode);
        $res_cnt_down = $main->get_count_down($cuscode);
        $res_add = $main->get_data_up($cuscode);
        $res_cnt_add = $main->get_count_up($cuscode);
        
        
        $data= ['res_cus'=>$res,
                    'res_down'=>$res_down,
                    'res_cnt_down'=>$res_cnt_down,
                    'res_add'=>$res_add,
                    'res_cnt_add'=>$res_cnt_add,
                    'amtbalance_txt'=>$amtbalance_txt,
                    'qtybalance' =>$qtybalance,
                    'doc_date'=>$doc_date,
                    'doc_approvedate'=>$doc_approvedate,
                    'amtbalance'=>$amtbalance
                ];

        return view('stock.stkdown',$data);
        
    }
    

    
    public function  main_list($cuscode = null){

        $clauses = [];
        if(isset($cuscodes)) {
            $clauses = array_merge($clauses,['XVCusCode' => $cuscode]);
        }        
        
         $res = DB::table('TStkTDownStock as a')
                 ->select('a.XVDowDocNo','a.XDDowDocDate', 
                            'a.XVCusCode',
                            DB::raw("CONCAT(XVCusFname,' ',XVCusLname) as XVCusName"),
                            'XVBchName','XVDivName','XVDowDocStatus','XBDowDocSend')
                 ->join('TStkMCustomer as b','a.XVCusCode','=','b.XVCusCode')
                 ->join('TComMBranch as c','b.XVBchCode','=','c.XVBchCode')
                 ->join('TComMDivision as d','b.XVDivCode','=','d.XVDivCode')
                 ->orderBy('XVDowDocNo', 'desc');//->toSql();
        // dd($res);

        if($cuscode != null){            
            $res = $res->where('a.XVCusCode', 'like', '%' .$cuscode. '%');    
        }
        
        $res = $res->paginate(12,array('XVDowDocNo'));

        return view('stock.stkdown_main',['res_all'=>$res]);
    }

    public function save(Request  $request)
    {
        try{
            $main  = new mainController();
            $docno = "";

        switch($request->_action ){
            case 'create':

                
                $docno = $main->gen_docno('TStkTDownStock', 'XVDowDocNo', 'SD');
                DB::table('TStkTDownStock')->insert(
                [
                    'XVDowDocNo' => $docno, 
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVCusCode' => $request->XVCusCode,
                    'XVBchCode' => $request->XVBchCode,
                    'XDDowDocDate' => $main->chg_sqldate($request->XDDowDocDate),
                    'XDDowApproveDate' => $main->chg_sqldate($request->XDDowApproveDate),
                    'XIDowQtyBalance' => $main->chg_repnumber($request->XIDowQtyBalance),
                    'XFDowAmtBalance' => $main->chg_repnumber($request->XFDowAmtBalance),                    
                    'XIDowQty' => $main->chg_repnumber($request->XIDowQty),
                    'XFDowAmount' => $main->chg_repnumber($request->XFDowAmount) ,
                    'XIDowSumQty' => $main->chg_repnumber($request->XIDowSumQty),
                    'XFDowSumAmount' => $main->chg_repnumber($request->XFDowSumAmount) ,                    
                    'XVDowDocStatus' => $request->doc_status,
                    'XBDowDocSend' => $request->doc_send,
                    'XVWhoEdit' => Auth::user()->username,
                    'XVWhoCreate' => Auth::user()->username,
                    'XTWhenEdit' => date("Y-m-d H:i:s"),
                    'XTWhenCreate' => date("Y-m-d H:i:s")
                ]
                );
                Alert::success('บันทึกข้อมูลสำเร็จ');
                break;
            case 'edit':
                
               
                $docno = $request->XVDowDocNo;
                DB::table('TStkTDownStock')
                        ->where('XVDowDocNo',$docno)
                        ->update(
                    [                    
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVCusCode' => $request->XVCusCode,
                    'XVBchCode' => $request->XVBchCode,
                    'XDDowDocDate' => $main->chg_sqldate($request->XDDowDocDate),
                    'XDDowApproveDate' => $main->chg_sqldate($request->XDDowApproveDate),
                    'XIDowQtyBalance' => $main->chg_repnumber($request->XIDowQtyBalance),
                    'XFDowAmtBalance' => $main->chg_repnumber($request->XFDowAmtBalance),      
                    'XIDowQty' => $main->chg_repnumber($request->XIDowQty),
                    'XFDowAmount' => $main->chg_repnumber($request->XFDowAmount) ,
                    'XIDowSumQty' => $main->chg_repnumber($request->XIDowSumQty),
                    'XFDowSumAmount' => $main->chg_repnumber($request->XFDowSumAmount) ,                    
                    'XVDowDocStatus' => $request->doc_status,
                    'XBDowDocSend' => $request->doc_send,
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
                    'XITrnQty' => $main->chg_repnumber($request->XIDowQty) * -1,
                    'XFTrnAmount' => $main->chg_repnumber($request->XFDowAmount) *-1 ,                    
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
        
        return redirect('/stkdown/'.$docno);

    }


}
