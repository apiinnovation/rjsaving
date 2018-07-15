<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests\UserRequest;
use Auth;
use App\Http\Controllers\mainController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main');
    }
    
    public function regis($username =null)
    {
        $main  = new mainController();
        $res= "";
        $res_userBch = "";
        
        if ($username != null){
            $action = 'edit';
            
        $res = DB::table('TComMUser as a')
                ->where('a.username', '=',$username)
                ->first();   
        
        $res_userBch = DB::table('TComMUserBranch as a')
                ->where('a.username', '=',$username)
                ->get();

        }else{
            $action = 'create';
        }
        
        
        $res_prefix = DB::table('TComMPrefix as a')->get();
        $res_bch = DB::table('TComMBranch as a')->get();


        if (!empty($username) &&  empty($res)){
            Alert::warning('ไม่พบรายการที่ค้นหา ', 'เกิดข้อผิดพลาด')->persistent('Close');
        }
        
        return view('auth.register',[
                                    'res'=>$res,
                                    'res_bch' =>$res_bch,
                                    'res_prefix' =>$res_prefix,
                                    'res_userBch'=>$res_userBch,
                                    'action'=>$action
                                    ]); 
    }
    
    public function updateUser(UserRequest $request){

        try{

            switch($request->_action ){
            case 'create':   
                
                $chk_dup = DB::table('TComMUser')
                    ->where('username',$request->username)->first();
                
                if (!empty($chk_dup)){
                    Alert::warning('ไม่สามารถบันทึกได้เนื่องจาก Username ซ้ำ ', 'เกิดข้อผิดพลาด')->persistent('Close');
                    return redirect()->to($this->getRedirectUrl())
                    ->withInput($request->input());

                }

                DB::table('TComMUser')->insert(
                [
                    'username' => $request->username, 
                    'password' => bcrypt($request->password), 
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVPreCode' => $request->XVPreCode,
                    'XVPreName' => $request->XVPreName,
                    'XVUserFName' => $request->XVUserFName,
                    'XVUserLName' => $request->XVUserLName,
                    'XVBchCode' => $request->XVBchCode,
                    'XVBchName' => $request->XVBchName,  
                    'XBIsSave' => $request->XBIsSave,
                    'XBIsApprove' => $request->XBIsApprove,
                    'XBIsReport' =>$request->XBIsReport,
                    'XBIsPrint' => $request->XBIsPrint,
                    'XBIsActive' => $request->XBIsActive,                    
                    'XVWhoEdit' => Auth::user()->username,
                    'XVWhoCreate' => Auth::user()->username,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                    ]
                    );
                break;
            case 'edit':
                
                
                if ($request->password !=""){

                    DB::table('TComMUser')
                        ->where('username',$request->username)
                        ->update(
                    [
                    'password' => bcrypt($request->password), 
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVPreCode' => $request->XVPreCode,
                    'XVPreName' => $request->XVPreName,
                    'XVUserFName' => $request->XVUserFName,
                    'XVUserLName' => $request->XVUserLName,
                    'XVBchCode' => $request->XVBchCode,
                    'XVBchName' => $request->XVBchName,  
                    'XBIsSave' => $request->XBIsSave,
                    'XBIsApprove' => $request->XBIsApprove,
                    'XBIsReport' =>$request->XBIsReport,
                    'XBIsPrint' => $request->XBIsPrint,
                    'XBIsActive' => $request->XBIsActive,                    
                    'XVWhoEdit' => Auth::user()->username
                    ]
                                
                );
                }else{           

                    DB::table('TComMUser')
                        ->where('username',$request->username)
                        ->update(
                    [                    
                    'XVEmpCode' => $request->XVEmpCode, 
                    'XVPreCode' => $request->XVPreCode,
                    'XVPreName' => $request->XVPreName,
                    'XVUserFName' => $request->XVUserFName,
                    'XVUserLName' => $request->XVUserLName,
                    'XVBchCode' => $request->XVBchCode,
                    'XVBchName' => $request->XVBchName,  
                    'XBIsSave' => $request->XBIsSave,
                    'XBIsApprove' => $request->XBIsApprove,
                    'XBIsReport' =>$request->XBIsReport,
                    'XBIsPrint' => $request->XBIsPrint,
                    'XBIsActive' => $request->XBIsActive,        
                    'XVWhoEdit' => Auth::user()->username
                    ]
                );
                }
                 DB::table('TComMUserBranch')->where('username', '=', $request->username)->delete();

                break;
            }
            
            foreach ($request->XVBchCodeRef as $selectedOption){
                     DB::table('TComMUserBranch')->insert(
                        [
                            'username' => $request->username, 
                            'XVBchCode' => $selectedOption,                    
                            'XVWhoCreate' => Auth::user()->username,
                            'XTWhenCreate' => date("Y-m-d H:i:s")
                            ]
                            ); 
                }
            Alert::success('บันทึกข้อมูลสำเร็จ');                
        } catch (Exception $ex) {
            console.log($ex);
            Alert::warning('บันทึกข้อมูลไม่สำเร็จ ', 'เกิดข้อผิดพลาด')->persistent('Close');
        }
        
        return redirect('/regis_main');
        
    }
    
    public function regis_main($name =null)
    {     
        
         $res = DB::table('TComMUser as a')
                 ->select('username','XBIsSave','XBIsApprove','XBIsReport','XBisPrint',
                            DB::raw("CONCAT( XVPreName,' ', XVUserFName,' ',XVUserLName) as XVUserName"),
                            'XVBchName','XBIsActive')
                 ->orderBy('XVUserFName', 'asc');//->toSql();


        if($name != null){            
            $res = $res->where('a.XVUserFName', 'like', '%' .$name. '%');    
        }
        
        $res = $res->paginate(10,array('XVUserFName'));

       // return view('stock.stkup_main',['res_all'=>$res]);
        return view('auth.register_main',['res_all'=>$res]);
    }
    
    }
