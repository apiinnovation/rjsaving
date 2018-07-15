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
        
        @include('layouts.menu')    
    </section>
    
    <br>
    <div class="col-sm-12">
        
        <form role="form" class="form-horizontal">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลผู้สมัคร</h3>                
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            
                <div class="box-body">
                    

                    <div class="form-group">    
                        <div class="row">
                        <label class="col-sm-2 control-label" style="text-align: right">ชื่อ-นามสกุล :</label>
                        <div class="col-sm-1">
                            <select class="form-control ">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <input type="text" class="form-control " placeholder="ชื่อ">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " placeholder="นามสกุล">
                        </div>
                        
                        </div>

                    </div>

                    <div class="form-group">                     
                        <div class="row">
                            <label class="col-md-2 control-label" style="text-align: right">เลขประจำตัว :</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control " placeholder=""  >
                            </div>        
                            <label class="col-md-1 control-label" style="text-align: right">สังกัด :</label>
                            <div class="col-sm-2">
                                <select class="form-control">
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
                    <label class="col-md-2 control-label " style="text-align: right">สาขาที่ดูแล :</label>
                    <div class="col-sm-2">
                    <select class="form-control select2" multiple="multiple" data-placeholder="เลือกสาขา"
                            style="width: 100%;">
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
                            <input type="checkbox" class="minimal" name="x" checked="">
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
                            <input type="checkbox" class="minimal" name="x" checked="">
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
                            <input type="checkbox" class="minimal" name="x" checked="">
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
                            <input type="checkbox" class="minimal" name="x" checked="">
                        </span>
                        <input type="text" class="form-control" value="อนุญาติพิมพ์" readonly="" >
                     </div>

                </div>
            </div>
                    
            </div>
                <!-- /.box-body -->
          </div>
              
          </form>
          <!-- /.box -->
    </div>

@endsection


@section('footer')
<!-- InputMask -->
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
    
  })
 </script>
    
@endsection