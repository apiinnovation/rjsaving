<?php $pageName = 'TStkMCustomer';?>


@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')

  <link rel="stylesheet" href="{{asset('css/apiform.css')}}">

@endsection


@section('content')


    <!-- Main content -->
  <section class="content-header">
      <!-- Small boxes (Stat box) 
                <a class="btn btn-app pull-right ">
                    <i class="fa fa-print"></i> พิมพ์
                </a>     
      -->


<!-- ทดสอบ -->
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-blue-gradient" >
                <h3 class="box-title">แก้ไขประวัติสมาชิก</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['method' => 'put','route' => ['TStkMCustomer.update',
                            $row->XVCusCode,$branch->XVBchName,$division->XVDivName]])  }}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                {{ Form::label('idgroup','รหัสพนักงาน : ') }}
                                {{ Form::text('XVCusCode',$row->XVCusCode,['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                {{ Form::label('idgroup','คำนำหน้านาม : ') }}
                                {{ Form::select('XVPreName', App\TComMPrefix::all()->pluck('XVPreName', 'XVPreName'), 
                                            $row->XVPreName, 
                                            ['class' => 'form-control', 'placeholder' => 'คำนำหน้านาม']) }} 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','ชื่อพนักงาน : ') }}
                                {{ Form::text('XVCusFname',$row->XVCusFname,['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','นามสกุล : ') }}
                                {{ Form::text('XVCusLname',$row->XVCusLname,['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','สังกัด : ') }}
                                {{ Form::select('XVBchName', App\TComMBranch::all()->pluck('XVBchName', 'XVBchName'), 
                                            $branch->XVBchName, 
                                            ['class' => 'form-control', 'placeholder' => 'กรุณาเลือกสาขา']) }} 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','แผนก : ') }}
                                {{ Form::select('XVDivName', App\TComMDivision::all()->pluck('XVDivName', 'XVDivName'), 
                                            $division->XVDivName, 
                                            ['class' => 'form-control', 'placeholder' => 'กรุณาเลือกแผนก']) }} 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','เลขบัตรประจำตัวประชาชน : ') }}
                                {{ Form::text('XVCusId',$row->XVCusId,['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','วันเดือนปีเกิด : ') }}
                                {{ Form::date('XDCusBdate',$row->XDCusBdate,['class' => 'form-control']) }}
                                <!-- <input id="inputdatepicker" class="datepicker" data-date-format="mm/dd/yyyy"> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','อายุ (ปี) : ') }}
                                {{ Form::text('XVCusId',$row->XVCusId,['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                
                
                {{ Form::close() }}
                
                
                
                
                
            </div>
        </div>
     </div>



    </section>
    <!-- /.content -->


@endsection


@section('footer')
<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>
  $(function () {

    $('[data-mask]').inputmask()



    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
  })
 </script>
    
@endsection
