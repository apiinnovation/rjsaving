<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use App\TComMDivision;
use App\TComMBranch;

class TComMDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$TComMDivision=TComMDivision::all();
        //$TComMDivision = TComMDivision::orderBy('XVDivName', 'asc')->paginate(10);    
        
        $TComMDivision = DB::table('TComMDivision')
                    ->leftJoin('TComMBranch', 'TComMDivision.XVBchCode', '=', 'TComMBranch.XVBchCode')
                    ->get();
        
        //$TComMDivision =TComMDivision:: with('TComMBranch')->orderBy('XVDivCode', 'asc')->paginate(10);

        //dd($TComMDivision);
        $data=array(
           'TComMDivision'=>$TComMDivision
        );
        
        return view('TComMDivision.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $error_h='';
        return view('TComMDivision.create',[
            'error_h'=>$error_h]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //XVDivCode','XVDivName','XVBchCode','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate
        $TComMDivision = new TComMDivision;
        $TComMDivision -> XVDivCode = trim($request -> XVDivCode);
        $TComMDivision -> XVDivName = trim($request -> XVDivName);
        $TComMDivision -> XVBchName = trim($request -> XVBchName);

        //dd($TComMDivision -> XVBchName);
        if (strlen($TComMDivision -> XVBchName)<1) {
            $error_h='คุณยังไม่ได้เลือกสาขา ่';
            return view('TComMDivision.create',[
                'error_h'=>$error_h]);            
        } else {
            $num = DB::table('TComMBranch')->where('XVBchName', $TComMDivision -> XVBchName)->first() ;
            //dd($num->XVBchCode);
            $TComMDivision -> XVBchCode=$num->XVBchCode;
        }


        if (strlen($TComMDivision -> XVDivCode)<1) {
            $error_h='คุณยังไม่ได้กรอกรหัส';
            return view('TComMDivision.create',[
                'error_h'=>$error_h]);            
        }

        if (strlen($TComMDivision -> XVDivName)<1) {
            $error_h='คุณยังไม่ได้กรอกชื่อแผนก ่';
            return view('TComMDivision.create',[
                'error_h'=>$error_h]);            
        }
        
        $TComMDivision -> XVWhoEdit = 'admin';   
        $TComMDivision -> XVWhoCreate = 'admin';   
        $TComMDivision -> XTWhenEdit = date("Y-m-d H:i:s");   
        $TComMDivision -> XTWhenCreate = date("Y-m-d H:i:s");   
        
        //XVDivCode','XVDivName','XVBchCode','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate
        DB::table('TComMDivision')->insert([
                'XVDivCode' => $TComMDivision -> XVDivCode,
                'XVDivName' => $TComMDivision -> XVDivName,
                'XVBchCode' => $TComMDivision -> XVBchCode,
                'XVWhoEdit' => $TComMDivision -> XVWhoEdit,
                'XVWhoCreate' => $TComMDivision -> XVWhoCreate,
                'XTWhenEdit' => $TComMDivision -> XTWhenEdit,
                'XTWhenCreate' => $TComMDivision -> XTWhenCreate                
             ]);
         
        return redirect('TComMDivision');
        

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
        //return ('Edit Div');
        $row = DB::table('TComMDivision')->where('XVDivCode', $id)->first();
        //dd($row);
        //dd($row->XVBchCode);
        $num = DB::table('TComMBranch')->where('XVBchCode', $row -> XVBchCode)->first() ;
        //$XVBchName=$num->XVBchName;
        //dd($XVBchName);
        $data=array(
            'row'=>$row,
            'num'=>$num
        );
        return view('TComMDivision/edit',$data);
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
        //dd($id);
        //XVDivCode','XVDivName','XVBchCode','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate
        $TComMDivision = new TComMDivision;
        //dd($TComMDivision);
        //$TComMDivision -> XVDivCode = trim($request -> XVDivCode);
        $TComMDivision -> XVDivName = trim($request -> XVDivName);
        $TComMDivision -> XVBchName = $request -> XVBchName;
        $num = DB::table('TComMBranch')->where('XVBchName', $request -> XVBchName)->first() ;
        //dd($num->XVBchCode);
        $TComMDivision -> XVBchCode=$num->XVBchCode;
        $TComMDivision -> XVWhoEdit = 'admin';   
        $TComMDivision -> XTWhenEdit = date("Y-m-d H:i:s");   
        //dd($request -> XVBchName);
        DB::table('TComMDivision')
                    ->where('XVDivCode',$id)
                    ->update([
                        'XVDivName' => $TComMDivision -> XVDivName,
                        'XVBchCode' => $TComMDivision -> XVBchCode,
                        'XVWhoEdit' => $TComMDivision -> XVWhoEdit,
                        'XTWhenEdit' => $TComMDivision -> XTWhenEdit
                        ]);
        return redirect('TComMDivision');
        
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
