<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use App\TComMPrefix;
use Session;


class TComMPrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TComMPrefix=TComMPrefix::all();
        //dd($TComMPrefix);
        $TComMPrefix = TComMPrefix::orderBy('XVPreName', 'asc')->paginate(10);
        $data=array(
           'TComMPrefix'=>$TComMPrefix
        );

        return view('TComMPrefix.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return ('OK Crea');
        $error_h='';
        return view('TComMPrefix.create',[
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
        //return ('St ok');
        //XVPreName','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate
        
        $TComMPrefix = new TComMPrefix;
        $TComMPrefix -> XVPreCode = trim($request -> XVPreCode);
        $TComMPrefix -> XVPreName = trim($request -> XVPreName);
        if (strlen($TComMPrefix -> XVPreCode)<1) {
            $error_h='คุณยังไม่ได้กรอกรหัส ่';
            return view('TComMPrefix.create',[
                'error_h'=>$error_h]);            
        }
        if (strlen($TComMPrefix -> XVPreName)<1) {
            $error_h='คุณยังไม่ได้กรอกคำนำหน้านาม';
            return view('TComMPrefix.create',[
                'error_h'=>$error_h]);            
        }
        $num = DB::table('TComMPrefix')->where('XVPreCode', $TComMPrefix -> XVPreCode)->count() ;
        //dd($num);
        //dd($num->XVPreCode);
        if ($num>0) {
            $error_h='รหัส '.$TComMPrefix -> XVPreCode.' มีอยู่แล้ว กรุณากรอกใหม่';
            return view('TComMPrefix.create',[
                'error_h'=>$error_h]);
        }
        $TComMPrefix -> XVWhoEdit = 'admin';   
        $TComMPrefix -> XVWhoCreate = 'admin';   
        $TComMPrefix -> XTWhenEdit = date("Y-m-d H:i:s");   
        $TComMPrefix -> XTWhenCreate = date("Y-m-d H:i:s");   
        //dd($TComMPrefix -> XVWhoEdit);
        //dd($TComMPrefix -> XVPreName);
        DB::table('TComMPrefix')->insert([
                'XVPreCode' => $TComMPrefix -> XVPreCode,
                'XVPreName' => $TComMPrefix -> XVPreName,
                'XVWhoEdit' => $TComMPrefix -> XVWhoEdit,
                'XVWhoCreate' => $TComMPrefix -> XVWhoCreate,
                'XTWhenEdit' => $TComMPrefix -> XTWhenEdit,
                'XTWhenCreate' => $TComMPrefix -> XTWhenCreate                
             ]);
         
        return redirect('TComMPrefix');
        

        
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
        $row = DB::table('TComMPrefix')->where('XVPreCode', $id)->first();
        $data=array(
            'row'=>$row
        );
        //dd($row);
        return view('TComMPrefix/edit',$data);
        
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
        $TComMPrefix = new TComMPrefix;
        //$TComMPrefix -> XVPreCode = trim($request -> XVPreCode);
        $TComMPrefix -> XVPreName = trim($request -> XVPreName);
        $TComMPrefix -> XVWhoEdit = 'admin';   
        $TComMPrefix -> XTWhenEdit = date("Y-m-d H:i:s");   
        //dd($TComMPrefix -> XTWhenEdit);
        DB::table('TComMPrefix')
                    ->where('XVPreCode',$id)
                    ->update([
                        'XVPreName' => $TComMPrefix -> XVPreName,
                        'XVWhoEdit' => $TComMPrefix -> XVWhoEdit,
                        'XTWhenEdit' => $TComMPrefix -> XTWhenEdit
                        ]);
        return redirect('TComMPrefix');
        
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
