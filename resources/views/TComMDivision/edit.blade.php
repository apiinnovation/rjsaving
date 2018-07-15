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
    <div class="col-md-4">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-green-gradient" >
                <h3 class="box-title">แก้ไขแผนก</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                {{ Form::open(['method' => 'put','route' => ['TComMDivision.update',$row->XVDivCode,$num->XVBchName]])  }}
                    <div class="form-group">
                    {{ Form::label('idgroup','รหัสแผนก : ') }}
                    {{ Form::label('XVDivCode',$row->XVDivCode) }}
                    </div>
                    <div class="form-group">
                    {{ Form::label('lnamegroup','ชื่อแผนก : ') }}
                    {{ Form::text('XVDivName',$row->XVDivName,['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                    {{ Form::label('lnamegroup','สาขาที่เลือกไว้ : ') }}
                    {{ Form::select('XVBchName', App\TComMBranch::all()->pluck('XVBchName', 'XVBchName'), $num->XVBchName, 
                                ['class' => 'form-control', 'placeholder' => 'กรุณาเลือกสาขาที่แผนกสังกัด']) }} 
                    </div>
                    {{ Form::submit('บันทึก',['class' => 'btn btn-primary pull-right']) }}
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
