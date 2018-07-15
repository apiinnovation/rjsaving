<?php $pageName = 'แก้ไข สมาชิก';?>


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
                {{ Form::open(['method' => 'put','route' => ['TStkMCustomer.update',
                            $row->XVCusCode,$branch->XVBchName,$division->XVDivName]])  }}
    <div class="col-md-12">
            <div class="box-body">
                <table align="right" cellpadding="100" cellspacing="100" >
                    <tr>
                        <td>
                            <button type="submit"  class="btn btn-danger btn-lg pull-right">บันทึก</button>    
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-lg pull-right">ยกเลิก</button>
                        </td>
                    </tr>
                </table>
            </div>
    </div>
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-blue-gradient" >
                <h3 class="box-title">แก้ไขประวัติสมาชิก</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            </div>
                            
                            <div class="form-group col-md-1">
                                <label for="FormControlFile1">รหัสพนักงาน :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusStaff" value={{ $row->XVCusCode }}>
                            </div>
                            <div class="form-group col-md-1">
                                {{ Form::label('idgroup','คำนำหน้านาม : ') }}
                                {{ Form::select('XVPreName', App\TComMPrefix::all()->pluck('XVPreName', 'XVPreName'), 
                                            $row->XVPreName, 
                                            ['class' => 'form-control', 'placeholder' => 'คำนำหน้านาม']) }} 
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">ชื่อ :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusFname" value={{ $row->XVCusFname }}>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">นามสกุล :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusLname" value={{ $row->XVCusLname }}>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','สังกัด : ') }}
                                {{ Form::select('XVBchName', App\TComMBranch::all()->pluck('XVBchName', 'XVBchName'), 
                                            $branch->XVBchName, 
                                            ['class' => 'form-control', 'placeholder' => 'กรุณาเลือกสาขา']) }} 
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('idgroup','แผนก : ') }}
                                {{ Form::select('XVDivName', App\TComMDivision::all()->pluck('XVDivName', 'XVDivName'), 
                                            $division->XVDivName, 
                                            ['class' => 'form-control', 'placeholder' => 'กรุณาเลือกแผนก']) }} 
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">เลขบัตรประจำตัวประชาชน :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusId" value={{ $row->XVCusId }}>
                            </div>
                            {{ $y=intval(substr($row->XDCusBdate,0,4))+543 }}
                            {{ $bdate=substr($row->XDCusBdate,8,2).'/'.substr($row->XDCusBdate,5,2).'/'.$y }}
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">วันเดือนปีเกิด :</label>
                                <i class="fa fa-calendar"></i>
                                <input class="datepicker" type="id"  data-date-language="th-th">
                            </div>
                            {{  $age=intval(substr(date('Y-m-d'),0,4)) - intval(substr($row->XDCusBdate,0,4)) }}
                            <div class="form-group col-sm-1">
                                <label for="FormControlFile1">อายุ (ปี) :</label>
                                <input class="form-control form-control-sm" type="text" name="age"  disabled="true" value={{ $age }}>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1" >เริ่มเข้าทำงาน :</label>
                                <i class="fa fa-calendar"></i>
                                <input id="inputdatepicker" class="datepicker form-control-sm" name ="XDCusBdateWork" data-date-format="mm/dd/yyyy">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="FormControlFile1">อายุงาน (ปี) :</label>
                                <input class="form-control form-control-sm" type="text" name="numwork" disabled >
                            </div>
                            <div class="form-group col-md-8">
                                <label for="FormControlFile1">ที่อยู่ :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusAddress" value={{ $row->XVCusAddress }}>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">โทรศัพท์ (ที่ทำงาน) :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusTelWork" value={{ $row->XVCusTelWork }}>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">โทรศัพท์ส่วนตัว :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusTelPrivate" value={{ $row->XVCusTelPrivate }}>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="FormControlFile1">เงินเดือน :</label>
                                <input class="form-control form-control-sm" type="text" name ="XFCusSalary" value={{ $row->XFCusSalary }}>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="FormControlFile1">สวัสดิการค่าอาหาร+ค่าครองชีพ :</label>
                                <input class="form-control form-control-sm" type="text" name ="XFCusWelfare" value={{ $row->XFCusWelfare }}>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="FormControlFile1">ชื่อธนาคาร ที่เปิดบัญชี :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusNameBank" value={{ $row->XVCusNameBank }}>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="FormControlFile1">เลขที่บัญชีธนาคาร :</label>
                                <input class="form-control form-control-sm" type="text" name ="XVCusBankId" value={{ $row->XVCusBankId }}>
                            </div>
                        </div>
            </div>
        </div>
     </div>
     <div class="col-md-8">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-fuchsia-active" >
                <h3 class="box-title">คู่สมรส / บุคคลอ้างอิง / ผู้รับผลประโยชน์</h3>
            </div>
            <div class="box-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                            <label class="col-lg-3 col-sm-3 " style="text-align: right">สถานภาพการสมรส :</label>
                            <label class="col-lg-2 col-sm-2">
                                <input type="radio" name="Marr" class="minimal"  {{ $row->XVCusMarriage == '1' ? 'checked' : '' }} >
                                โสด
                            </label>
                            <label class="col-lg-2 col-sm-2">
                                <input type="radio" name="Marr" class="minimal"  {{ $row->XVCusMarriage == '2' ? 'checked' : '' }} >
                                สมรส
                            </label>
                            <label class="col-lg-2 col-sm-2">
                                <input type="radio" name="Marr" class="minimal"  {{ $row->XVCusMarriage == '3' ? 'checked' : '' }} >
                                หย่า/หม้าย
                            </label>
                    </div>
                    <div class="form-group col-md-2">
                                {{ Form::label('idgroup','คำนำหน้านาม : ') }}
                                {{ Form::select('XVCusPrefixMarriage', App\TComMPrefix::all()->pluck('XVCusPrefixMarriage', 'XVCusPrefixMarriage'), 
                                            $row->XVCusPrefixMarriage, 
                                            ['class' => 'form-control', 'placeholder' => 'คำนำหน้านาม']) }} 
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">ชื่อคู่สมรส :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusFnameMarriage" value={{ $row->XVCusFnameMarriage }}>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">นามสกุลคู่สมรส :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusLnameMarriage" value={{ $row->XVCusLnameMarriage }}>
                    </div>
                    <div class="form-group col-md-12">
                            <label class="col-lg-3 col-sm-3 " style="text-align: right">ที่ทำงานคู่สมรส :</label>
                            <label class="col-lg-2 col-sm-2">
                                <input type="radio" name="addMarr" class="minimal"  {{ $row->XVCusAddressMarriage == '1' ? 'checked' : '' }} >
                                ทำที่ RJ.
                            </label>
                            <label class="col-lg-2 col-sm-2">
                                <input type="radio" name="addMarr" class="minimal"  {{ $row->XVCusAddressMarriage == '2' ? 'checked' : '' }} >
                                ไม่ได้ทำ
                            </label>
                            <label class="col-lg-2 col-sm-2">
                                <input type="radio" name="addMarr" class="minimal"  {{ $row->XVCusAddressMarriage == '3' ? 'checked' : '' }} >
                               ทำที่อื่น
                            </label>  
                    </div>
                    <div class="form-group col-md-7">
                        <label for="FormControlFile1">ระบุ :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusDetailAddMarriage" value={{ $row->XVCusDetailAddMarriage }}>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">โทรศัพท์ :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusTelMarriage" value={{ $row->XVCusTelMarriage }}>
                    </div>
                    <div class="form-group col-md-2">
                                {{ Form::label('idgroup','คำนำหน้านาม : ') }}
                                {{ Form::select('XVCusPrefixReference', App\TComMPrefix::all()->pluck('XVCusPrefixReference', 'XVCusPrefixReference'), 
                                            $row->XVCusPrefixReference, 
                                            ['class' => 'form-control', 'placeholder' => 'คำนำหน้านาม']) }} 
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">ชื่อบุคคลที่อ้างอิงได้ :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusFnameReference" value={{ $row->XVCusFnameReference }}>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">นามสกุล :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusLnameReference" value={{ $row->XVCusLnameReference }}>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">เกี่ยวข้องเป็น :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusConnectReference" value={{ $row->XVCusConnectReference }}>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="FormControlFile1">โทรศัพท์ :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusTelReference" value={{ $row->XVCusTelReference }}>
                    </div>
                    <div class="form-group col-md-2">
                                {{ Form::label('idgroup','คำนำหน้านาม : ') }}
                                {{ Form::select('XVCusPrefixBeneficiary', App\TComMPrefix::all()->pluck('XVCusPrefixBeneficiary', 'XVCusPrefixBeneficiary'), 
                                            $row->XVCusPrefixBeneficiary, 
                                            ['class' => 'form-control', 'placeholder' => 'คำนำหน้านาม']) }} 
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">ชื่อผู้รับผลประโยชน์แทน :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusFnameBeneficiary" value={{ $row->XVCusFnameBeneficiary }}>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">นามสกุล :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusLnameBeneficiary" value={{ $row->XVCusLnameBeneficiary }}>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="FormControlFile1">เกี่ยวข้องเป็น :</label>
                        <input class="form-control form-control-sm" type="text" name ="XVCusConnectBeneficiary" value={{ $row->XVCusConnectBeneficiary }}>
                    </div>
                    
                </div>
            </div>
        </div>
     </div>
    <div class="col-md-4">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-gray-active" >
                <h3 class="box-title">สมาชิก</h3>
            </div>
            <div class="box-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                            <div class="form-group col-md-8">
                                <label for="FormControlFile1">วันที่อนุมัติเป็นสมาชิก :</label>
                                <i class="fa fa-calendar"></i>
                                <input id="inputdatepicker" class="datepicker form-control-sm" name ="XDCusDateIn" data-date-format="mm/dd/yyyy" disabled="true">
                            </div>
                        <div class="form-group col-md-4">
                            <label for="FormControlFile1">หมายเลขสมาชิก :</label>
                            <input class="form-control form-control-sm" type="text" name ="XVCusCode" disabled="true" value={{ $row->XVCusCode }} >
                        </div>
                        <div class="form-group col-md-8">
                            <label for="FormControlFile1">ปัจจุบันส่งเงินสะสมต่อเดือน : (บาท)</label>
                            <input class="form-control form-control-sm" type="text" name ="XFCusBeginsavings" disabled="true" value={{ $row->XFCusBeginsavings }}>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="FormControlFile1">จำนวนหุ้นที่มี :</label>
                            <input class="form-control form-control-sm" type="text" name ="XICusBeginQtyStock" disabled="true" value={{ $row->XICusBeginQtyStock }}>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
     </div>
            {{ Form::close() }}
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

    $('.datepicker').datepicker();


    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
  })
 </script>
    
@endsection
