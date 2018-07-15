<?php $pageName = 'TComMPrefix.index';?>


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
            <div class="box-header with-border bg-green-gradient" >
                <h3 class="box-title">คำนำหน้านาม</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <a class="btn btn-app pull-right " href="{{ url('TComMPrefix/create')}}">
                    <i class="fa fa-file-o"></i> เพิ่มคำนำหน้านาม
                </a> 
                
                @if (count($errors) > 0)
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif                
                
                    <table class="table table-striped table table-bordered">
                        <tr class="active">
                            <th width="0%"  class="text-center">รหัส</th>
                            <th width="60%" class="text-left">คำนำหน้านาม</th>
                            <th  width="40%" class="text-center">Option</th>
                        </tr>
                        @foreach ($TComMPrefix as $row)
                        <tr class="bg-info">
                            <td class="text-center"> {{ $row['XVPreCode'] }} </td>
                            <td class="text-left"> {{ $row['XVPreName'] }} </td>
                            <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs">
                                        <a href=" {{ url('TComMPrefix/'.$row->XVPreCode.'/edit')}} ">แก้ไข</a>
                                    </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $TComMPrefix->render() !!}
                
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
