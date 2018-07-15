<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests;

use App\TComMBranch;
use App\Http\Requests\BranchRequest;



class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function index($pBchCode=null)
    {
       $res_all = TComMBranch::all();
       $code = $this->genCode();
       $res_edit =  DB::table('TComMBranch')->where('XVBchCode', $pBchCode)->first();
       
       //print $res_edit;
       if ($res_edit){
           $action ='edit';
       }else{
           $action ='create';
       }
       
       
       return view('main.branch',[
                                    'action'=>$action,
                                    'last_code'=>$code,
                                    'res_all'=>$res_all,
                                    'res_edit'=>$res_edit
                                        ]);        
    }
    
    public function genCode()
    {
        
        $last_code = "";
        $res = DB::select('SELECT  MAX(CAST(XVBchCode as INT)) as XVBchCode  FROM TComMBranch' );
        if (empty($res[0]->XVBchCode)) {
            $last_code =1;
        } else {
            $last_code = $res[0]->XVBchCode + 1;            
        }
        
        $last_code  = sprintf('%03d', $last_code);
        return  $last_code;                      
    }


    public function save(BranchRequest $request)
    {

        if ($request->_action =="create"){
            $request->XVBchCode = $this->genCode();
        }

        DB::table('TComMBranch')->where('XVBchCode', '=', $request->XVBchCode)->delete();
        DB::table('TComMBranch')->insert(
                [
                    'XVBchCode' => $request->XVBchCode, 
                    'XVBchName' => $request->XVBchName,
                    'XVBchAddress' => $request->XVBchAddress,
                    'XVBchPhone' => $request->XVBchPhone,
                    'XVBchFax' => $request->XVBchFax,
                    'XVWhoEdit' => 'admin',
                    'XVWhoCreate' => 'admin',
                    'XTWhenEdit' => date("Y-m-d H:i:s"),
                    'XTWhenCreate' => date("Y-m-d H:i:s")
                ]
        );
        
        Alert::success('บันทึกข้อมูลสำเร็จ');

        return redirect('/branch');

    }


    public function del($id)
    {
        DB::table('TComMBranch')->where('XVBchCode', '=', $id)->delete();
        return back();
    }

}
