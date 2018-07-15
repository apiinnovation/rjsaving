<?php $pageName = 'TComMDivision';?>


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
    <div class="col-md-6">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-green-gradient" >
                <h3 class="box-title">แผนก</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <a class="btn btn-app pull-right " href="{{ url('TComMDivision/create')}}">
                    <i class="fa fa-file-o"></i> เพิ่มคำนำหน้านาม
                </a> 
                
                    <table class="table table-striped table table-bordered">
                        <tr class="active">
                            <th width="5%"  class="text-center">รหัส</th>
                            <th width="40%" class="text-left">ชื่อแผนก</th>
                            <th width="35%" class="text-left">สาขา</th>
                            <th  width="20%" class="text-center">Option</th>
                        </tr>
                        @foreach ($TComMDivision as $row)
                        <tr class="bg-info">
                            <td class="text-center"> {{ $row->XVDivCode }} </td>
                            <td class="text-left"> {{ $row->XVDivName }} </td>
                            <td class="text-left"> {{ $row->XVBchName }} </td>
                            <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs">
                                        <a href=" {{ url('TComMDivision/'.$row->XVDivCode.'/edit')}} ">แก้ไข</a>
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
