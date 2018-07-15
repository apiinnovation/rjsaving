<?php $pageName = 'สมัครสมาชิก';?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')

  <link rel="stylesheet" href="{{asset('css/apiform.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection


@section('content')
<form class="form-horizontal" role="form" id="frm" method="POST" action="{{ url('/register') }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="col-sm-4">
            <h1>
            {{ $pageName}}
            </h1>
        </div>
        <?php
        $menu =1;
        
        ?>
        
        <a class="btn btn-app pull-right ">              
        <i class="fa fa-search"></i> ค้นหา
      </a>      
      <a class="btn btn-app pull-right ">
        <i class="fa fa-minus"></i> ลบ
      </a>  
        <a class="btn btn-app pull-right " id="btn_save">
        <i class="fa fa-save"></i> บันทึก
      </a>  
      <a class="btn btn-app pull-right ">
        <i class="fa fa-file-o"></i> เพิ่ม
      </a> 
    </section>
    
    <br>
    <div class="col-sm-12">
        
        
            {{ csrf_field() }}
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลผู้สมัคร</h3>                
            </div>
            
                <div class="box-body">
                    

                    <div class="form-group">    
                        <div class="row">
                        <label class="col-sm-2 control-label" style="text-align: right">ชื่อ-นามสกุล :</label>
                        <div class="col-sm-1">
                            <select class="form-control " name="XVPrecode" id="XVPrecode">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select>
                            <input type="hidden" class="form-control " name="XVPreName" id="XVPreName" >
                        </div>

                        <div class="col-sm-2">
                            <input type="text" class="form-control " placeholder="ชื่อ" name="XVUserFName" id="XVUserFName" >
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " placeholder="นามสกุล" name="XVUserLName" id="XVUserLName">
                        </div>
                        
                        </div>

                    </div>

                    <div class="form-group">                     
                        <div class="row">
                            <label class="col-md-2 control-label" style="text-align: right">รหัสพนักงาน :</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control " placeholder="" id="XVEmpCode" name="XVEmpCode" value=""  >
                            </div>        
                            <label class="col-md-1 control-label" style="text-align: right">สังกัด :</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="XVBchCode" name="XVBchCode">
                                <option>ท่านผู้หญิง</option>
                                <option>อุทัยรัตน์</option>
                                <option>บองมาร์เช่</option>
                                <option>RJ Design</option>
                                <option>RJ.4</option>
                                </select>
                                <input type="hidden" class="form-control " placeholder="" id="XVBchName" name="XVBchName" >
                            </div>     

                        </div>
                    </div>
                    
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right">สาขาที่ดูแล :</label>
                    <div class="col-sm-2">
                    <select class="form-control select2" multiple="multiple" data-placeholder="เลือกสาขา"
                            style="width: 100%;" id="bchref" name="bchref">
                      <option>ท่านผู้หญิง</option>
                      <option>อุทัยรัตน์</option>
                      <option>บองมาร์เช่</option>
                      <option>RJ Design</option>
                      <option>RJ.4</option>
                    </select>
                    </div>
                </div>
            </div>
                    
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-2">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsSave" checked="" id="XBIsSave" value="1">
                        </span>
                        <input type="text" class="form-control" value="อนุญาตบันทึกเอกสาร" readonly="">
                     </div>

                </div>
            </div>
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-2">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsApprove" id="XBIsApprove" checked="" value="1">
                        </span>
                        <input type="text" class="form-control" value="อนุญาตอนุมัติเอกสาร" readonly="">
                     </div>

                </div>
            </div>
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-2">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsReport" id="XBIsReport" checked="" value="1">
                        </span>
                        <input type="text" class="form-control" value="อนุญาตดูรายงาน" readonly="">
                     </div>

                </div>
            </div>
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-2">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBisPrint" id="XBisPrint" checked="" value="1">
                        </span>
                        <input type="text" class="form-control" value="อนุญาติพิมพ์" readonly="" >
                     </div>

                </div>
            </div>   
                    
            <hr>
            <div class="form-group">    
                <div class="row">
                <label class="col-sm-2 control-label" style="text-align: right">User :</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control " placeholder="User" name="XVUserCode" id="XVUserCode" >
                </div>
                </div>

            </div>                    
            <div class="form-group">    
                <div class="row">
                <label class="col-sm-2 control-label" style="text-align: right">Password :</label>
                <div class="col-sm-2">
                    <input type="password" class="form-control " placeholder="Password" name="XVUserPassword" id="XVUserPassword">
                </div>
                </div>

            </div>   
            <div class="form-group">    
                <div class="row">
                <label class="col-sm-2 control-label" style="text-align: right">Confirm Password :</label>
                <div class="col-sm-2">
                    <input type="password" class="form-control " placeholder="Confirm Password" id="confirmpass" name="confirmpass">
                </div>
                </div>

            </div>                     
            </div>                
          </div>
    </div>
</form>       
@endsection


@section('footer')

<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()

    $('[data-mask]').inputmask()
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
    
    $( "#btn_save" ).click(function() {
        $( "#frm" ).submit();
    });
    
  })
 </script>
    
@endsection
