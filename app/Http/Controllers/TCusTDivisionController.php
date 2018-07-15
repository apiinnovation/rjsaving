<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreadddivisionRequest;

use App\Http\Requests;
use App\TCusTDivision;
//use DB;

class TCusTDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$objs= TCusTDivision::all();
        //$objs= TCusTDivision::orderBy('XVDivName')->get();
        //$users = DB::select('select * from users where active = ?', [1]);
        //$objs= DB::select('select * from TCusTDivision');
        
        $TCusTDivision= TCusTDivision::paginate(10);
        //$data['objs']=$objs;
        return view('frmdivision.division',[
            TCusTDivisions=>$TCusTDivision
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frmdivision.adddivision');        
        //return 'ok';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreadddivisionRequest $request)
    {
        //return $request->XVDivName;
        //return 'ok';
        $TCusTDivision= new TCusTDivision();
        $TCusTDivision->XVDivName=$request->XVDivName;
        $TCusTDivision->XVDivWhoEdit='';
        $TCusTDivision->XVDivWhoCreate='';
        $TCusTDivision->save();
        
        //$TCusTDivision->create($request->all());
        return redirect()->action('TCusTDivisionController@index');
        
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
        //$TCusTDivision= TCusTDivision::find($id);
        //$TCusTDivision= new TCusTDivision();
        //$TCusTDivision = TCusTDivision::where('XVDivCode', '=', $id)‐>get();
        //$TCusTDivision = DB::table('TCusTDivisions')->where('XVDivCode', $id)->get();
        $TCusTDivision = TCusTDivision::where('XVDivCode', '=','{{ $id }}')‐>first();
        return view('frmdivision.editdivision',[
            'TCusTDivision'=>$TCusTDivision
        ]);
        //return $id;
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
        //
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
