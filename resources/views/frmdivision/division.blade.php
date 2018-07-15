<?php $pageName = 'division';?>


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
    <div class="col-md-5">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-green-gradient" >
                <h3 class="box-title">แผนก</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <a class="btn btn-app pull-right " href="{{ url('TCusTDivision/create')}}">
               <i class="fa fa-file-o"></i> เพิ่มข้อมูลแผนก
        </a> 
                <table class="table table-sm table-bordered table table-striped">
                    <thead>
                        <tr class="bg-primary">
                            <th width="15%" rowspan="2" ><h5><p class="text-center"> รหัสแผนก</p></h5></th>
                            <th width="30%" rowspan="2"><h5><p class="text-center"> ชื่อแผนก</p></h5></th>
                            <th width="20%" rowspan="2"><h5><p class="text-center"> Option</p></h5></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($TCusTDivision as $row)
                            <tr class="bg-info">
                                <td class="text-center">{{$row->XVDivCode}}</td>
                                <td class="text-left">{{$row->XVDivName}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs">
                                        <a href=" {{ url('TCusTDivision/'.$row->XVDivCode.'/edit')}} ">แก้ไข</a>
                                    </button>
                                </td>
                            </tr>
                         @endforeach
     
                    </tbody>
                </table>
                {!! $TCusTDivision->render() !!}
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
