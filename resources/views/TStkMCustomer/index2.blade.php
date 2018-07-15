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
    <div class="col-md-4">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-blue-gradient" >
                <h3 class="box-title">ค้นสมาชิกตามสาขา</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['url' => 'TStkMCustomer/add'])  }}
                    <div class="form-group">
                    {{ Form::label('lnamegroup','เลือกสาขา : ') }}
                    {{ Form::select('XVBchName', App\TComMBranch::all()->pluck('XVBchName', 'XVBchName'), null, 
                                ['class' => 'form-control', 'placeholder' => 'แสดงรายชื่อทั้งหมดทุกสาขา']) }} 
                    </div>
                    {{ Form::submit('เริ่มค้นหา',['class' => 'btn btn-primary pull-right']) }}
                {{ Form::close() }}
                
            </div>
        </div>
     </div>
    <div class="col-md-4">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-blue-gradient" >
                <h3 class="box-title">ค้นหาสมาชิกตาม รหัส หรือชื่อ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['url' => 'TStkMCustomer/addfind'])  }}
                    <div class="form-group">
                    {{ Form::label('lnamegroup','กรุณาใส่ รหัส หรื่อชื่อบางตัวอักษรที่ต้องการค้นหา : ') }}
                    {{ Form::text('tmpform',' ',['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('เริ่มค้นหา',['class' => 'btn btn-primary pull-right']) }}
                {{ Form::close() }}
                
            </div>
        </div>
     </div>

    <div class="col-md-8">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-orange-active" >
                <h3 class="box-title">รายชื่อสมาชิก {{ $branch }}</h3>
            </div>
            <div class="box-body">
                    <table class="table table-striped table table-bordered">
                        <tr class="active">
                            <th width="0%"  class="text-center">รหัส</th>
                            <th width="20%" class="text-right">คำนำหน้านาม</th>
                            <th width="30%" class="text-left">ชื่อ</th>
                            <th width="30%" class="text-left">นามสกุล</th>
                            <th  width="20%" class="text-center">Option</th>
                        </tr>
                        @foreach ($TStkMCustomer as $row)
                        <tr class="bg-info">
                            <td class="text-center"> {{ $row['XVCusCode'] }} </td>
                            <td class="text-right"> {{ $row['TPreCode'] }} </td>
                            <td class="text-left"> {{ $row['XVCusFname'] }} </td>
                            <td class="text-left"> {{ $row['XVCusLname'] }} </td>
                            <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs">
                                        <a href=" {{ url('TStkMCustomer/'.$row->XVCusCode.'/edit')}} ">รายละเอียด</a>
                                    </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
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
