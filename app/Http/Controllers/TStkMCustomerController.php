<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\TStkMCustomer;
use App\TComMBranch;
use App\TComMDivision;


class TStkMCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$TStkMCustomer=TStkMCustomer::all();
        $TStkMCustomer = TStkMCustomer::orderBy('XVCusFname', 'asc')->get();
        $branch='';
        $data=array(
           'TStkMCustomer'=>$TStkMCustomer,
            'branch'=>$branch
        );
        return view('TStkMCustomer.index',$data);
    }

    public function add(Request $request) 
    {
        //return ('Ok Add');
        $XVBchName=$request->XVBchName;
        //dd($XVBchName);
        if (strlen($XVBchName)<1) {
            //$TStkMCustomer = TStkMCustomer::orderBy('XVCusFname', 'asc')->paginate(20);
            $TStkMCustomer = TStkMCustomer::orderBy('XVCusFname', 'asc')->get();
            $branch='ทุกสาขา';
        } else {
            $row = DB::table('TComMBranch')->where('XVBchName', $XVBchName)->first();
            $data=array(
                'row'=>$row
            );
            //dd($row);
            $TStkMCustomer = TStkMCustomer::where('XVBchCode', '=', $row->XVBchCode)
                                            -> orderby('XVCusFname', 'asc')
                                            -> get();
            $branch='สาขา : '.$XVBchName;
            //dd($TStkMCustomer);
        }
        $data=array(
           'TStkMCustomer'=>$TStkMCustomer,
            'branch'=>$branch
        );
        return view('TStkMCustomer.index',$data);
        
    }
    
    public function addfind(Request $request) 
    {
        //return ('Add find');
        $num = TStkMCustomer::where('XVCusFname', 'LIKE', trim($request->tmpform).'%')-> count();
        if ($num<1) {
            $TStkMCustomer = TStkMCustomer::where('XVCusCode', '=', trim($request->tmpform))-> get();
            $branch = 'ตามรหัส';
            //dd(trim($request->tmpform));
        } else {
            $TStkMCustomer = TStkMCustomer::where('XVCusFname', 'LIKE', trim($request->tmpform).'%')
                                                -> orderby('XVCusFname', 'asc')
                                                -> get();
            $branch = 'ตามตัวอักษร ที่ขึ้นต้นด้วย : '.trim($request->tmpform);
        }
        
        $data=array(
           'TStkMCustomer'=>$TStkMCustomer,
            'branch'=>$branch
        );
        return view('TStkMCustomer.index',$data);
        
    }        
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = DB::table('TStkMCustomer')->where('XVCusCode', $id)->first();
        $branch = DB::table('TComMBranch')->where('XVBchCode', $row -> XVBchCode)->first() ;
        $division = DB::table('TComMDivision')->where('XVDivCode', $row -> XVDivCode)->first() ;
        //$XVBchName=$num->XVBchName;
        //dd($XVBchName);
        if (is_null($branch)) {
            $branch->XVBchName='เลือกสาขา';
        } else {
            $branch->XVBchName=$branch->XVBchName;
        }
        if ($division= nullValue()) {
            $division->XVDivName='เลือกแผนก';
        }
        $data=array(
            'row' => $row,
            'branch' => $branch,
            'division' => $division
        );
        return view('TStkMCustomer.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return ($request->XVCusFname.$request->XVCusLname.$request->XDCusBdate);
       // return ('Update');
        $TStkMCustomer = new TStkMCustomer;

        $TStkMCustomer -> XVCusStaff = trim($request -> XVCusStaff );  
        $TStkMCustomer -> XVPreName = trim($request -> XVPreName );  
        $TStkMCustomer -> XVCusFname = trim($request -> XVCusFname );  
        $TStkMCustomer -> XVCusLname = trim($request -> XVCusLname );  

        //dd($request);
        $TStkMCustomer -> XVBchName = trim($request -> XVBchName );  
        //XVBchCode
        
        $TStkMCustomer -> XVDivName = trim($request -> XVDivName );  
        //XVDivCode
        
        $TStkMCustomer -> XVCusId = trim($request -> XVCusId );  

        $d=substr($request -> XDCusBdate,0,2);
        $m=substr($request -> XDCusBdate,3,2);
        $y= intval(substr($request -> XDCusBdate,6,4))-543;
        $TStkMCustomer -> XDCusBdate = date('Y-m-d',strtotime($y.'/'.$m.'/'.$d));

        $d=substr($request -> XDCusBdateWork,0,2);
        $m=substr($request -> XDCusBdateWork,3,2);
        $y= intval(substr($request -> XDCusBdateWork,6,4))-543;
        $TStkMCustomer -> XDCusBdateWork = date('Y-m-d',strtotime($y.'/'.$m.'/'.$d));
        
 
        //คำนวนอายุงาน
       
        $TStkMCustomer -> XVCusAddress = $request -> XVCusAddress;
        $TStkMCustomer -> XVCusTelWork = trim($request -> XVCusTelWork );
        $TStkMCustomer -> XVCusTelPrivate = trim($request -> XVCusTelPrivate );
        $TStkMCustomer -> XFCusSalary = $request -> XFCusSalary;
        $TStkMCustomer -> XFCusWelfare = $request -> XFCusWelfare;
        $TStkMCustomer -> XVCusNameBank = trim($request -> XVCusNameBank );
        $TStkMCustomer -> XVCusBankId = trim($request -> XVCusBankId );
        
        $TStkMCustomer -> XVCusMarriage = trim($request -> XVCusMarriage );
        $TStkMCustomer -> XVCusPrefixMarriage = trim($request -> XVCusPrefixMarriage );
        $TStkMCustomer -> XVCusFnameMarriage = trim($request -> XVCusFnameMarriage );
        $TStkMCustomer -> XVCusLnameMarriage = trim($request -> XVCusLnameMarriage );
        $TStkMCustomer -> XVCusAddressMarriage = trim($request -> XVCusAddressMarriage );
        $TStkMCustomer -> XVCusDetailAddMarriage = trim($request -> XVCusDetailAddMarriage );
        $TStkMCustomer -> XVCusTelMarriage = trim($request -> XVCusTelMarriage );
        $TStkMCustomer -> XVCusPrefixReference = trim($request -> XVCusPrefixReference );
        $TStkMCustomer -> XVCusFnameReference = trim($request -> XVCusFnameReference );
        $TStkMCustomer -> XVCusLnameReference = trim($request -> XVCusLnameReference );
        $TStkMCustomer -> XVCusConnectReference = trim($request -> XVCusConnectReference );
        $TStkMCustomer -> XVCusTelReference = trim($request -> XVCusTelReference );
        $TStkMCustomer -> XVCusPrefixBeneficiary = trim($request -> XVCusPrefixBeneficiary );
        $TStkMCustomer -> XVCusFnameBeneficiary = trim($request -> XVCusFnameBeneficiary );
        $TStkMCustomer -> XVCusLnameBeneficiary = trim($request -> XVCusLnameBeneficiary );
        $TStkMCustomer -> XVCusConnectBeneficiary = trim($request -> XVCusConnectBeneficiary );
        
        //$TStkMCustomer -> XDCusDateIn = $request -> XDCusDateIn;
        //$TStkMCustomer -> XVCusCode = trim($request -> XVCusCode );
        //$TStkMCustomer -> XFCusBeginsavings = $request -> XFCusBeginsavings;
        //$TStkMCustomer -> XICusBeginQtyStock = $request -> XICusBeginQtyStock;
        
        $TStkMCustomer -> XVWhoEdit = 'admin';   
        $TStkMCustomer -> XTWhenEdit = date("Y-m-d H:i:s");   

        //XVPreCode XVEmpCode
       //'XVStkDocNo' ,'XVCusStatus' ,'XVCusDoc'   ,'XVCusSend' 
        
        DB::table('TStkMCustomer')
                    ->where('XVCusCode',$id)
                    ->update([
                        'XVCusStaff' => $TStkMCustomer -> XVCusStaff,
                        'XVPreName' => $TStkMCustomer -> XVPreName,
                        'XVCusFname' => $TStkMCustomer -> XVCusFname,
                        'XVCusLname' => $TStkMCustomer -> XVCusLname,
                        'XVCusId' => $TStkMCustomer -> XVCusId,
                        'XDCusBdate' => $TStkMCustomer -> XDCusBdate,
                        'XDCusBdateWork' => $TStkMCustomer -> XDCusBdateWork
                        ]);
        //return redirect('TComMDivision');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
